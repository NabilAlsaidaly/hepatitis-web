<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Treatment extends Model
{
    protected $primaryKey = 'Treatment_ID';

    protected $fillable = ['Diagnosis_ID', 'Treatment_Name'];

    public function prediction(): BelongsTo
{
    return $this->belongsTo(Prediction::class, 'Prediction_ID', 'Prediction_ID');
}

}
