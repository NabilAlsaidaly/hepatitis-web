<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MedicalRecord;
use App\Models\Prediction;
use App\Models\Diagnosis;
use App\Models\Treatment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MedicalRecordController extends Controller
{
    // 🧾 تخزين تحليل جديد


public function store(Request $request)
{
    $validated = $request->validate([
        'patient_id'    => 'required|exists:patients,Patients_ID',
        'Age'           => 'required|numeric',
        'Sex'           => 'required|numeric',
        'ALT'           => 'required|numeric',
        'AST'           => 'required|numeric',
        'ALB'           => 'nullable|numeric',
        'ALP'           => 'nullable|numeric',
        'BIL'           => 'nullable|numeric',
        'CHE'           => 'nullable|numeric',
        'CHOL'          => 'nullable|numeric',
        'CREA'          => 'nullable|numeric',
        'GGT'           => 'nullable|numeric',
        'PROT'          => 'nullable|numeric',
        'prediction'    => 'required|integer',
        'probabilities' => 'required|array',
        'treatment'     => 'required|string',
    ]);

    DB::beginTransaction();
    try {
        // 1️⃣ سجل التحاليل
        $record = MedicalRecord::create([
            'Patients_ID' => $validated['patient_id'],
            'Doctor_ID'   => Auth::id(),
            'Age'         => $validated['Age'],
            'Sex'         => $validated['Sex'],
            'ALB'         => $validated['ALB'] ?? null,
            'ALP'         => $validated['ALP'] ?? null,
            'ALT'         => $validated['ALT'],
            'AST'         => $validated['AST'],
            'BIL'         => $validated['BIL'] ?? null,
            'CHE'         => $validated['CHE'] ?? null,
            'CHOL'        => $validated['CHOL'] ?? null,
            'CREA'        => $validated['CREA'] ?? null,
            'GGT'         => $validated['GGT'] ?? null,
            'PROT'        => $validated['PROT'] ?? null,
        ]);

        // 2️⃣ توقع المرض (النموذج الذكي)
        $prediction = new Prediction();
        $prediction->Record_ID     = $record->Record_ID;
        $prediction->result        = $validated['prediction'];
        $prediction->probabilities = $validated['probabilities'];
        $prediction->save();

        // 3️⃣ العلاج
        $treatment = new Treatment();
        $treatment->Prediction_ID  = $prediction->Prediction_ID; // المفتاح الجديد
        $treatment->Treatment_Name = $validated['treatment'];
        $treatment->save();

        DB::commit();
        return response()->json(['message' => '✅ تم حفظ التحليل والتشخيص والعلاج بنجاح']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json([
            'error' => '❌ فشل أثناء الحفظ: ' . $e->getMessage()
        ], 500);
    }
}


}



