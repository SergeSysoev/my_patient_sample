<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property float $value
 * @property string $date
 * @property Patient $patient
 */
class Diuresis extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'diuresis';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'value', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
