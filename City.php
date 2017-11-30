<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $region_id
 * @property string $name
 * @property Region $region
 * @property Address[] $addresses
 */
class City extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['region_id', 'name'];
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function region()
    {
        return $this->belongsTo('App\Region');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses()
    {
        return $this->hasMany('App\Address');
    }
}
