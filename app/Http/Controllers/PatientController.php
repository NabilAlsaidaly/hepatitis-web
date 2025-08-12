<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Treatment;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PatientController extends Controller
{
    public function list(Request $request)
    {
        try {
            $doctorId = Auth::id();
            Log::info("📥 طلب قائمة المرضى للطبيب: " . ($doctorId ?? 'غير مسجّل'));

            // التحقق من تسجيل الدخول
            if (!$doctorId) {
                Log::error("❌ فشل التحقق من تسجيل الدخول. لا يوجد معرف مستخدم. ربما لم يتم تسجيل الدخول أو الجلسة انتهت.");
                return response()->json(['error' => 'الرجاء تسجيل الدخول كطبيب.'], 401);
            }

            // جلب المرضى
            $patients = Patient::where('Doctor_ID', $doctorId)
                ->select('Patients_ID as id', 'Name', 'Date_Of_Birth', 'Contact_Info')
                ->get();

            Log::info("✅ تم جلب " . $patients->count() . " مريض(اً) للطبيب رقم: " . $doctorId);

            return response()->json($patients);
        } catch (\Throwable $e) {
            Log::error("🛑 استثناء غير متوقع أثناء جلب المرضى: " . $e->getMessage());
            Log::error("📁 مزيد من التفاصيل في ملف: storage/logs/laravel.log");

            return response()->json(['error' => 'حدث خطأ غير متوقع. يرجى مراجعة السجل.'], 500);
        }
    }




    public function store(Request $request)
    {
        // 🔐 التحقق من صحة البيانات
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'contact_info' => 'nullable|string',
            'email' => 'required|email|unique:users,Email',
            'password' => 'required|string|min:4',
        ]);

        // 🧑‍⚕️ الحصول على الطبيب الحالي
        $doctor = Auth::user();
        if (!$doctor || $doctor->Role_ID !== 1) {
            return response()->json(['error' => '⚠️ غير مصرح لك بإضافة المرضى'], 403);
        }

        // ✅ إنشاء المستخدم كمريض
        $user = User::create([
            'Name' => $request->name,
            'Email' => $request->email,
            'Password' => $request->password, // تُشفّر تلقائيًا في الـ Model
            'Role_ID' => 2, // 🩺 مريض
        ]);

        // ✅ ربط المستخدم الجديد بسجل المريض
        $patient = Patient::create([
            'Name' => $request->name,
            'Date_Of_Birth' => $request->dob,
            'Contact_Info' => $request->contact_info,
            'Doctor_ID' => $doctor->User_ID,
            'User_ID' => $user->getKey(),
        ]);

        return response()->json([
            'message' => '✅ تم إضافة المريض مع حسابه بنجاح',
            'patient' => $patient
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'dob' => 'nullable|date',
            'contact_info' => 'nullable|string',
        ]);

        $patient = Patient::findOrFail($id);
        $patient->update([
            'Name' => $request->name,
            'Date_Of_Birth' => $request->dob,
            'Contact_Info' => $request->contact_info,
        ]);

        return response()->json(['message' => '✅ تم تعديل المريض', 'patient' => $patient]);
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();

        return response()->json(['message' => '🗑️ تم حذف المريض']);
    }


    public function records($id)
    {
        $patient = Patient::findOrFail($id);

        $records = $patient->medicalRecords()->with(['prediction.treatment', 'diagnosis'])->orderByDesc('created_at')->get();


        return response()->json([
            'patient' => [
                'name' => $patient->Name,
                'dob' => $patient->Date_Of_Birth,
                'contact' => $patient->Contact_Info,
            ],
            'records' => $records
        ]);
    }

    public function latestRecord($patientId)
    {
        try {
            $doctorId = Auth::id();
            Log::info("📡 استدعاء latestRecord للمريض: {$patientId} بواسطة الطبيب: {$doctorId}");

            // 🧠 التحقق من أن المريض يتبع لهذا الطبيب
            $patient = Patient::where('Patients_ID', $patientId)
                ->where('Doctor_ID', $doctorId)
                ->firstOrFail();

            // ✅ تحميل أحدث سجل مع التنبؤ والعلاج المرتبط به
            $record = $patient->medicalRecords()
                ->with(['prediction.treatment'])  // ⭐ هذا هو بيت القصيد
                ->latest('created_at')
                ->first();

            if (!$record) {
                Log::warning("⚠️ لا يوجد سجل تحاليل للمريض رقم: {$patientId}");
                return response()->json(['error' => '⚠️ لا يوجد سجل تحاليل لهذا المريض.'], 404);
            }

            // ✅ استخراج العلاج من العلاقة بشكل مباشر
            $treatment = $record->prediction?->treatment?->Treatment_Name ?? 'غير متوفر';
            Log::info("🎯 العلاج المقترح للتنبؤ رقم {$record->prediction->Prediction_ID}: {$treatment}");

            return response()->json([
                'record_id' => $record->Record_ID,
                'alt' => $record->ALT,
                'ast' => $record->AST,
                'alp' => $record->ALP,
                'bil' => $record->BIL,
                'che' => $record->CHE,
                'alb' => $record->ALB,
                'chol' => $record->CHOL,
                'crea' => $record->CREA,
                'ggt' => $record->GGT,
                'prot' => $record->PROT,
                'prediction' => $record->prediction?->result ?? null,
                'probabilities' => $record->prediction?->probabilities ?? [],
                'suggested_treatment' => $treatment,
            ]);
        } catch (\Exception $e) {
            Log::error('❌ خطأ في latestRecord: ' . $e->getMessage());
            return response()->json(['error' => '❌ حدث خطأ أثناء جلب السجل الطبي.'], 500);
        }
    }

    public function diagnoses()
    {
        // 🧠 الحصول على المريض المسجل للدخول
        $user = Auth::user();
        $patient = Patient::where('User_ID', $user->User_ID)->firstOrFail();

        // ✅ جلب جميع سجلات المريض مع التشخيص والطبيب
        $records = MedicalRecord::with(['diagnosis', 'doctor'])
            ->where('Patients_ID', $patient->Patients_ID)
            ->orderByDesc('created_at')
            ->get();

        return view('patient.sections.diagnoses', compact('records'));
    }
}
