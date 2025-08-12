<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Diagnosis;
use App\Models\MedicalRecord;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiagnosisController extends Controller
{
    public function storeLSTM(Request $request)
    {
        $request->validate([
            'patient_id' => 'required|integer|exists:patients,Patients_ID',
            'stage' => 'required|integer|min:0|max:4',
        ]);

        $latestRecord = MedicalRecord::where('Patients_ID', $request->patient_id)
            ->orderByDesc('created_at')
            ->first();

        if (!$latestRecord) {
            return response()->json(['error' => 'لا يوجد سجل تحاليل لهذا المريض.'], 404);
        }

        $diagnosis = Diagnosis::create([
            'Record_ID' => $latestRecord->Record_ID,
            'disease_stage' => $request->stage,
        ]);

        return response()->json([
            'message' => '✅ تم حفظ نتيجة تحليل تطور المرض بنجاح.',
            'diagnosis' => $diagnosis
        ]);
    }


    public function storeFinalDiagnosis(Request $request)
    {
        try {
            // ✅ التحقق من صحة البيانات
            $validated = $request->validate([
                'record_id' => 'required|exists:medical_records,Record_ID',
                'final_diagnosis' => 'required|string',
                'prescription' => 'required|string',
            ]);

            // ✅ إنشاء التشخيص
            $diagnosis = Diagnosis::create([
                'Record_ID' => $validated['record_id'],
                'Final_Diagnosis' => $validated['final_diagnosis'],
                'Prescription' => $validated['prescription'],
            ]);

            Log::info("✅ تم حفظ تشخيص نهائي للسجل رقم: {$validated['record_id']}");

            return response()->json([
                'message' => '✅ تم حفظ التشخيص النهائي بنجاح.',
                'diagnosis' => $diagnosis
            ]);
        } catch (\Throwable $e) {
            Log::error("❌ خطأ أثناء حفظ التشخيص النهائي: " . $e->getMessage());
            return response()->json([
                'error' => '❌ حدث خطأ أثناء حفظ التشخيص. الرجاء المحاولة لاحقًا.'
            ], 500);
        }
    }

    public function doctorLog()
    {
        $doctorId = Auth::id();

        $diagnoses = Diagnosis::with('record.patient')
            ->whereHas('record', fn($q) => $q->where('Doctor_ID', $doctorId))
            ->latest()
            ->get()
            ->map(function ($d) {
                return [
                    'patient_name' => $d->record->patient->Name ?? '—',
                    'date' => $d->created_at->format('Y-m-d'),
                    'final_diagnosis' => $d->Final_Diagnosis,
                    'prescription' => $d->Prescription,
                ];
            });

        return response()->json($diagnoses);
    }


    public function list(Request $request)
    {
        try {
            $doctorId = Auth::id();
            $patientId = $request->query('patient_id');

            Log::info("📡 طلب قائمة التشخيصات للطبيب: {$doctorId}" . ($patientId ? "، للمريض: {$patientId}" : ""));

            // 🧠 تحقق من أن المريض (إن وجد) يتبع للطبيب الحالي
            if ($patientId) {
                $patient = Patient::where('Patients_ID', $patientId)
                    ->where('Doctor_ID', $doctorId)
                    ->firstOrFail();
            }

            // ✅ جلب جميع التشخيصات التي تخص الطبيب، وتصفيتها إن وُجد patient_id
            $diagnoses = Diagnosis::with(['record.patient'])
                ->whereHas('record', function ($q) use ($doctorId, $patientId) {
                    $q->where('Doctor_ID', $doctorId);
                    if ($patientId) {
                        $q->where('Patients_ID', $patientId);
                    }
                })
                ->orderByDesc('created_at')
                ->get();

            if ($diagnoses->isEmpty()) {
                Log::info("📭 لا توجد تشخيصات للطبيب: {$doctorId}" . ($patientId ? " لهذا المريض" : ""));
            }

            // ✅ تنسيق النتائج
            $result = $diagnoses->map(function ($diag) {
                return [
                    'patient_name' => optional($diag->record->patient)->Name,
                    'date' => $diag->created_at->format('Y-m-d H:i'),
                    'diagnosis' => $diag->Final_Diagnosis,
                    'prescription' => $diag->Prescription,
                ];
            });

            return response()->json($result);
        } catch (\Exception $e) {
            Log::error("❌ خطأ أثناء تحميل التشخيصات: " . $e->getMessage());
            return response()->json(['error' => '❌ حدث خطأ أثناء تحميل التشخيصات.'], 500);
        }
    }
}
