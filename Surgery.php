<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $patient_id
 * @property string $name
 * @property string $description
 * @property int $file_id
 * @property string $date
 * @property Patient $patient
 */
class Surgery extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['patient_id', 'name', 'description', 'file_id', 'date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function patient()
    {
        return $this->belongsTo('App\Patient');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function files()
    {
        return $this->hasMany('App\File');
    }
}
