<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property float $morning_value
 * @property float $evening_value
 * @property string $date
 * @property Patient $patient
 */
class Temperature extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'value', 'date'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
