<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property InstrumentalExam[] $instrumentalExams
 */
class InstrumentalExamType extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function instrumentalExams()
    {
        return $this->hasMany('App\InstrumentalExam', 'type_id');
    }
}
