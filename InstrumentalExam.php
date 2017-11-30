<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $description
 * @property int $file_id
 * @property string $date
 * @property Patient $patient
 * @property InstrumentalExamType $instrumentalExamType
 */
class InstrumentalExam extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'type_id', 'description', 'file_id', 'date'];

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
    public function instrumentalExamType()
    {
        return $this->belongsTo('App\InstrumentalExamType', 'type_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }
}
