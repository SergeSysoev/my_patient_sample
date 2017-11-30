<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $value
 * @property Patient $patient
 * @property DiagnosisType $diagnosisType
 */
class Diagnosis extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'diagnosis';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'type_id', 'value'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo('App\DiagnosisType', 'type_id');
    }
}
