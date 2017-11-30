<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property int $file_id
 * @property string $date
 * @property Patient $patient
 * @property AnalysisType $analysisType
 */
class Analysis extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'analysis';

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'type_id', 'date', 'description', 'result', 'readiness'];

    protected $hidden = ['type_id', 'patient_id'];

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
        return $this->belongsTo('App\AnalysisType', 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\File', 'belongs_to_id');
    }
}
