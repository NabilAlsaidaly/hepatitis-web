<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم الأدمن</title>

    <!-- Bootstrap RTL -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">

    <!-- أيقونات وخطوط -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f5f5f5;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            padding: 10px;
            display: block;
        }
        .sidebar a.active, .sidebar a:hover {
            background-color: #495057;
        }
        canvas {
            max-width: 100% !important;
            width: 100% !important;
            direction: ltr !important;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- الشريط الجانبي -->
            <div class="col-md-2 sidebar">
                @include('admin.components.sidebar')
            </div>

            <!-- المحتوى -->
            <div class="col-md-10 p-0">
                @include('admin.components.navbar')

                <main class="p-4">
                    @yield('content')
                </main>
            </div>
        </div>
    </div>

    <!-- سكريبتات خاصة بالصفحات -->
    @stack('scripts')
</body>
</html>
