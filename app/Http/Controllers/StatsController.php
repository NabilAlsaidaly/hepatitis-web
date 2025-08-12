<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\MedicalRecord;
use App\Models\Report;
use App\Models\Prediction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StatsController extends Controller
{
    public function summary()
    {
        // ✅ مؤشرات عامة
        $patientsCount = Patient::count();
        $recordsCount = MedicalRecord::count();
        $reportsCount = Report::count();
        $predictionsCount = Prediction::count();

        // ✅ توزيع الفئات التشخيصية
        $distributionRaw = Prediction::select('result')
            ->selectRaw('COUNT(*) as count')
            ->groupBy('result')
            ->get();

        $labels = [
            0 => "🟢 سليم",
            1 => "🟡 مشتبه",
            2 => "🟠 التهاب",
            3 => "🔴 تليف",
            4 => "🚨 تشمع",
        ];

        $distribution = [];
        foreach ($distributionRaw as $item) {
            $label = $labels[$item->result] ?? "غير معروف";
            $distribution[$label] = $item->count;
        }

        return response()->json([
            'patients' => $patientsCount,
            'records' => $recordsCount,
            'reports' => $reportsCount,
            'predictions' => $predictionsCount,
            'distribution' => $distribution
        ]);
    }


   public function summaryForDoctor()
{
    $doctorId = Auth::id();
    Log::info("📥 طلب إحصائيات الطبيب رقم: " . ($doctorId ?? 'غير معروف'));

    if (!$doctorId) {
        Log::error("❌ فشل جلب إحصائيات الطبيب: لم يتم تسجيل الدخول.");
        return response()->json(['error' => 'الرجاء تسجيل الدخول كطبيب.'], 401);
    }

    try {
        // 🧍‍♂️ المرضى المرتبطين بالطبيب
        $patientsCount = Patient::where('Doctor_ID', $doctorId)->count();

        // 🧪 سجلات التحاليل لهؤلاء المرضى
        $recordsCount = MedicalRecord::whereHas('patient', function ($q) use ($doctorId) {
            $q->where('Doctor_ID', $doctorId);
        })->count();

        // 📄 تقارير مرضى الطبيب
        $reportsCount = Report::whereHas('patient', function ($q) use ($doctorId) {
            $q->where('Doctor_ID', $doctorId);
        })->count();

        // 🧠 تحليلات الذكاء الصناعي الخاصة بسجلات المرضى
        $predictionsCount = Prediction::whereHas('record.patient', function ($q) use ($doctorId) {
            $q->where('Doctor_ID', $doctorId);
        })->count();

        // 📊 توزيع نتائج AI لفئات المرض
        $distributionRaw = Prediction::select('result')
            ->selectRaw('COUNT(*) as count')
            ->whereHas('record.patient', function ($q) use ($doctorId) {
                $q->where('Doctor_ID', $doctorId);
            })
            ->groupBy('result')
            ->get();

        $labels = [
            0 => "🟢 سليم",
            1 => "🟡 مشتبه",
            2 => "🟠 التهاب",
            3 => "🔴 تليف",
            4 => "🚨 تشمع",
        ];

        $distribution = [];
        foreach ($distributionRaw as $item) {
            $label = $labels[$item->result] ?? "غير معروف";
            $distribution[$label] = $item->count;
        }

        return response()->json([
            'patients' => $patientsCount,
            'records' => $recordsCount,
            'reports' => $reportsCount,
            'predictions' => $predictionsCount,
            'distribution' => $distribution
        ]);
    } catch (\Exception $e) {
        Log::error("❌ فشل أثناء حساب الإحصائيات للطبيب: " . $e->getMessage());
        return response()->json(['error' => 'حدث خطأ أثناء تحميل الإحصائيات.'], 500);
    }
}


}
