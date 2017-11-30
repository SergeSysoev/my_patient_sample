<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Diagnosis[] $diagnoses
 */
class DiagnosisType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function diagnoses()
    {
        return $this->hasMany('App\Diagnosis', 'type_id');
    }
}
