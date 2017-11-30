<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property int $type_id
 * @property string $file
 * @property string $date
 * @property Patient $patient
 * @property AnalysisType $analysisType
 */
class File extends Model
{

    const ANALYSIS = 1;
    const INSTRUMENTAL_EXAM = 2;
    const SURGERY = 3;

    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'file', 'belongs_to', 'belongs_to_id'];

    protected $hidden = ['belongs_to', 'belongs_to_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function analysis()
    {
        return $this->belongsTo('App\Analysis', 'id', 'belongs_to_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function instrumentalExam()
    {
        return $this->belongsTo('App\InstrumentalExam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function surgery()
    {
        return $this->belongsTo('App\Surgery');
    }
}
