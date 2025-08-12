<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Diagnosis extends Model
{
    protected $primaryKey = 'Diagnosis_ID';

    // 🧠 الأعمدة المسموحة للملء
    protected $fillable = [
        'Record_ID',
        'Final_Diagnosis',
        'Prescription',
    ];

    // 🔗 علاقة بالسجل الطبي المرتبط
    public function record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'Record_ID');
    }
}
