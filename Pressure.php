<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $low_morning
 * @property int $high_morning
 * @property int $low_evening
 * @property int $high_evening
 * @property string $date
 * @property Patient $patient
 */
class Pressure extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'low', 'high', 'date'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
