<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class MedicalRecord extends Model
{
    protected $primaryKey = 'Record_ID';

    protected $fillable = [
        'Patients_ID',
        'Doctor_ID',
        'Age',
        'Sex',
        'ALT',
        'AST',
        'ALP',
        'BIL',
        'CHE',
        'ALB',
        'CHOL',
        'CREA',
        'GGT',
        'PROT'
    ];


    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class, 'Patients_ID');
    }

    public function prediction(): HasOne
    {
        return $this->hasOne(Prediction::class, 'Record_ID');
    }

    public function diagnosis(): HasOne
    {
        return $this->hasOne(Diagnosis::class, 'Record_ID');
    }

    public function doctor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'Doctor_ID');
    }
}
