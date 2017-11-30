<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Chamber extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'number', 'beds', 'department_id',
    ];

    public $timestamps = false;

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function patients()
    {
        return $this->hasMany('App\Patient');
    }

}
