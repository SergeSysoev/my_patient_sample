<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property Analysis[] $analyses
 */
class AnalysisType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function analyses()
    {
        return $this->hasMany('App\Analysis', 'type_id');
    }
//
//    public function patients()
//    {
//        return $this->belongsToMany('App\Patient');
//    }
}
