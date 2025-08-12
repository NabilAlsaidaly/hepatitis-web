<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Prediction extends Model
{
    protected $primaryKey = 'Prediction_ID';

    protected $fillable = ['Record_ID', 'result', 'probabilities'];

    protected $casts = [
        'probabilities' => 'array',
    ];

    public function record(): BelongsTo
    {
        return $this->belongsTo(MedicalRecord::class, 'Record_ID');
    }

    public function treatment(): HasOne
{
    return $this->hasOne(Treatment::class, 'Prediction_ID', 'Prediction_ID');
}



}
