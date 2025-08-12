<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use ReflectionClass;
use Illuminate\Support\Facades\File;

class GenerateStructureMap extends Command
{
    protected $signature = 'generate:structure-map';
    protected $description = 'Generates a project structure map linking routes, controllers, views, models, and JS files';

    public function handle()
    {
        $routes = Route::getRoutes();
        $structure = [];

        foreach ($routes as $route) {
            $action = $route->getActionName();

            if ($action === 'Closure') continue;

            // تحقق إذا كانت الدالة تحتوي على "@" لتجنب الخطأ
            if (strpos($action, '@') !== false) {
                [$controller, $method] = explode('@', $action);
            } else {
                continue; // تجاهل هذه الـ Route إذا لم يكن يحتوي على "@" بشكل صحيح
            }

            $path = base_path('app/' . str_replace('\\', '/', Str::after($controller, 'App\\')) . '.php');
            if (!file_exists($path)) continue;

            $source = file_get_contents($path);

            // ابحث عن اسم الـ View
            preg_match_all("/return\s+view\(['\"](.*?)['\"]/", $source, $viewMatches);
            $views = $viewMatches[1] ?? [];

            // ابحث عن أسماء الـ Models (بشكل مبسط)
            preg_match_all("/(\\\?App\\\Models\\\)?([A-Z][A-Za-z0-9_]+)::/", $source, $modelMatches);
            $models = array_unique($modelMatches[2]);

            $structure[] = [
                'route' => $route->uri(),
                'method' => $route->methods()[0],
                'controller' => class_basename($controller),
                'controller_path' => $controller,
                'controller_method' => $method,
                'views' => $views,
                'models' => $models,
            ];
        }

        $markdown = "# 🔍 Project Structure Map\n\n";

        foreach ($structure as $item) {
            $markdown .= "## 🔹 Route: `{$item['method']} {$item['route']}`\n";
            $markdown .= "- Controller: `{$item['controller']}@{$item['controller_method']}`\n";
            $markdown .= "- Full Path: `{$item['controller_path']}`\n";

            if (!empty($item['models'])) {
                $markdown .= "- Models used: " . implode(', ', $item['models']) . "\n";
            }

            if (!empty($item['views'])) {
                $markdown .= "- Views returned:\n";
                foreach ($item['views'] as $view) {
                    $markdown .= "  - `$view`\n";

                    // تحقق من وجود ملف JS بنفس اسم الـ Blade
                    $jsPath = public_path("js/" . str_replace('.', '/', $view) . ".js");
                    if (file_exists($jsPath)) {
                        $markdown .= "    - 🔗 JS File: `public/js/" . str_replace('.', '/', $view) . ".js`\n";
                        $markdown .= "      - Size: " . round(filesize($jsPath) / 1024, 2) . " KB\n";
                    }
                }
            }

            $markdown .= "\n---\n\n";
        }

        // === إضافة جديدة: عرض جميع ملفات js في public/js/ ===
        $jsDir = public_path('js');

        if (is_dir($jsDir)) {
            $files = File::allFiles($jsDir);

            $markdown .= "\n## 📁 Public JS Files (`public/js/`)\n";

            foreach ($files as $file) {
                $relativePath = str_replace(public_path(), '', $file->getPathname());
                $markdown .= "- `$relativePath`\n";
                $markdown .= "  - Size: " . round($file->getSize() / 1024, 2) . " KB\n";
            }
        }

        // حفظ الملف
        File::put(base_path('structure-map.md'), $markdown);

        $this->info('✅ Structure map generated successfully in structure-map.md');
    }
}
