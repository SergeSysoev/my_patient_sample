<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property int $id
 * @property int $address_id
 * @property int $chamber_id
 * @property string $first_name
 * @property string $middle_name
 * @property string $last_name
 * @property integer $sex
 * @property string $birth_date
 * @property string $phone
 * @property string $med_history_number
 * @property string $created_at
 * @property string $updated_at
 * @property Address $address
 * @property Chamber $chamber
 * @property Analysis[] $analyses
 * @property AnalysisType[] $analysesTypes
 * @property ClinicalInformation[] $clinicalInformation
 * @property Diagnosis[] $diagnoses
 * @property Diuresis[] $diuresis
 * @property InstrumentalExam[] $instrumentalExams
 * @property Pressure[] $pressures
 * @property Surgery[] $surgeries
 * @property Temperature[] $temperatures
 */
class Patient extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['address_id', 'chamber_id', 'first_name', 'middle_name', 'last_name', 'sex', 'birth_date', 'phone', 'med_history_number', 'created_at', 'updated_at'];

    protected $appends = [
        'full_name',
    ];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address()
    {
        return $this->hasOne('App\Address', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chamber()
    {
        return $this->belongsTo('App\Chamber');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function analyses()
    {
        return $this->hasMany('App\Analysis');
    }

//    public function analysesTypes($typeId = false)
//    {
//        if($typeId)
//        {
//            return $this->hasMany('App\Analysis');
//        }
//        return 1;
//    }

    public function analysesTypes($typeId)
    {
        if($typeId)
        {
            return DB::table('analysis_types')
                ->select('analysis.id as id', 'date', 'description', 'result', 'readiness')
                ->join('analysis', 'analysis_types.id', '=', 'analysis.type_id')
//                ->join('files', 'analysis.id', '=', 'files.belongs_to_id')
                ->where([
                    ['analysis.patient_id', '=', $this->id],
                    ['analysis.type_id', '=', $typeId],
//                    ['files.belongs_to', '=', File::ANALYSIS],
                ])
                ->get();
        }
        return DB::table('analysis_types')
            ->select('analysis_types.id as id', 'name')
            ->join('analysis', 'analysis_types.id', '=', 'analysis.type_id')
            ->where('analysis.patient_id', $this->id)
            ->groupBy('name')
            ->get();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function clinicalInformation()
    {
        return $this->hasOne('App\ClinicalInformation');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagnoses()
    {
        return $this->hasMany('App\Diagnosis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diuresis()
    {
        return $this->hasMany('App\Diuresis');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instrumentalExams()
    {
        return $this->hasMany('App\InstrumentalExam');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pressures()
    {
        return $this->hasMany('App\Pressure');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function surgeries()
    {
        return $this->hasMany('App\Surgery');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function temperatures()
    {
        return $this->hasMany('App\Temperature');
    }

    public function getFullNameAttribute()
    {
        return $this->last_name . ' ' . $this->first_name . ' ' . $this->middle_name;
    }
}
