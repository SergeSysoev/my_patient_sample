<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property User[] $user
 */
class Staff extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['first_name', 'middle_name', 'last_name', 'sex', 'user_id', 'role_id'];

    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\belongsTo
     */
    public function role()
    {
        return $this->belongsTo('App\Role');
    }
}
