<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Department extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'chief_id',
    ];

    public $timestamps = false;

    public function chambers()
    {
        return $this->hasMany('App\Chamber');
    }
}
