<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property string $complaints
 * @property string $an_morbi
 * @property string $an_vitae
 * @property string $an_allergo
 * @property string $an_job
 * @property string $an_transfuz
 * @property string $an_admission
 * @property string $per_rectum
 * @property string $ambulatory_examination
 * @property Patient $patient
 */
class ClinicalInformation extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'clinical_information';
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'complaints', 'an_morbi', 'an_vitae', 'an_allergo', 'an_job', 'an_transfuz', 'an_admission', 'per_rectum', 'ambulatory_examination', 'pgi'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }
}
