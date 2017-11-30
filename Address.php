<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $city_id
 * @property string $street
 * @property string $house
 * @property string $building
 * @property string $apartment
 * @property City $city
 * @property Patient[] $patients
 */
class Address extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['city_id', 'street', 'house', 'building', 'apartment'];
    public $timestamps = false;

    protected $appends = [
        'full_address',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function city()
    {
        return $this->belongsTo('App\City');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function patients()
    {
        return $this->belongsToMany('App\Patient');
    }

    public function getFullAddressAttribute()
    {
        $building = $this->building ? ', стр. ' . $this->building : '';
        $apartment = $this->apartment ? ', кв. ' . $this->apartment : '';
        return $this->city->name . ', ул. ' . $this->street . ', д. ' . $this->house . $building . $apartment;
    }
}
