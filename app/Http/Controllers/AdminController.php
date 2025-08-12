<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Patient;
use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class AdminController extends Controller
{
    // ✅ 1. لوحة التحكم العامة
    public function dashboard()
    {
        $doctorCount = User::where('Role_ID', 1)->count();
        $patientCount = Patient::count();
        $recordsCount = MedicalRecord::count();

        return view('admin.sections.dashboard', compact('doctorCount', 'patientCount', 'recordsCount'));
    }

    // ✅ 2. عرض الأطباء فقط (Role_ID = 1)
    public function indexDoctors()
    {
        $doctors = User::where('Role_ID', 1)->get();
        return view('admin.sections.doctors', compact('doctors'));
    }

    // ✅ 3. عرض المرضى بدون معلومات حساسة (بدون الاسم)
    public function indexPatients()
    {
        $patients = Patient::select('Patients_ID', 'Date_Of_Birth', 'Doctor_ID', 'created_at')->get();
        return view('admin.sections.patients', compact('patients'));
    }

    public function showExportPage()
    {
        return view('admin.sections.export');
    }

    // ✅ 4. تصدير بيانات المرضى بصيغة CSV

    public function exportCSV()
    {
        $records = MedicalRecord::with('prediction')->get();

        $filename = 'medical_records_export.csv';
        $handle = fopen('php://temp', 'w+');

        // رأس الجدول
        $headers = [
            'Age',
            'Sex',
            'ALB',
            'ALP',
            'ALT',
            'AST',
            'BIL',
            'CHE',
            'CHOL',
            'CREA',
            'GGT',
            'PROT',
            'Prediction'
        ];
        fputcsv($handle, $headers);

        // جدول التحويل من رقم إلى نص
        $labels = [
            0 => 'Healthy',
            1 => 'Suspected',
            2 => 'Hepatitis',
            3 => 'Fibrosis',
            4 => 'Cirrhosis'
        ];

        // البيانات
        foreach ($records as $record) {
            $predictionValue = $record->prediction->result ?? null;
            $predictionText = $predictionValue !== null ? ($labels[$predictionValue] ?? 'Unknown') : '—';

            fputcsv($handle, [
                $record->Age,
                $record->Sex,
                $record->ALB,
                $record->ALP,
                $record->ALT,
                $record->AST,
                $record->BIL,
                $record->CHE,
                $record->CHOL,
                $record->CREA,
                $record->GGT,
                $record->PROT,
                $predictionText
            ]);
        }

        rewind($handle);
        $csvContent = stream_get_contents($handle);
        fclose($handle);

        return Response::make($csvContent, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$filename",
        ]);
    }


    public function storeDoctor(Request $request)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|string|min:6',
        ]);

        \App\Models\User::create([
            'Name' => $validated['Name'],
            'Email' => $validated['Email'],
            'Password' => $validated['Password'], // سيتم تشفيرها تلقائيًا
            'Role_ID' => 1, // 👨‍⚕️ دكتور
        ]);

        return redirect()->route('admin.doctors')->with('success', '✅ تم إضافة الطبيب بنجاح');
    }

    public function editDoctor($id)
    {
        $doctor = \App\Models\User::where('Role_ID', 1)->findOrFail($id);
        return view('admin.sections.edit-doctor', compact('doctor'));
    }

    public function updateDoctor(Request $request, $id)
    {
        $validated = $request->validate([
            'Name' => 'required|string|max:255',
            'Email' => 'required|email|unique:users,Email,' . $id . ',User_ID',
            'Password' => 'nullable|string|min:6',
        ]);

        $doctor = \App\Models\User::where('Role_ID', 1)->findOrFail($id);

        $doctor->Name = $validated['Name'];
        $doctor->Email = $validated['Email'];

        if (!empty($validated['Password'])) {
            $doctor->Password = $validated['Password']; // سيتم تشفيرها تلقائيًا
        }

        $doctor->save();

        return redirect()->route('admin.doctors')->with('success', '✅ تم تعديل الطبيب بنجاح');
    }

    public function deleteDoctor($id)
    {
        $doctor = \App\Models\User::where('Role_ID', 1)->findOrFail($id);
        $doctor->delete();

        return redirect()->route('admin.doctors')->with('success', '🗑️ تم حذف الطبيب بنجاح');
    }

    // ✅ عرض المرضى مع الطبيب المعالج لهم فقط
    public function patientsWithDoctors()
    {
        $patients = \App\Models\Patient::with('doctor')
            ->select('Patients_ID', 'Name', 'Doctor_ID')
            ->get();

        return view('admin.sections.patients-doctors', compact('patients'));
    }
}
