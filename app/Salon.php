<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Salon extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'name', 'email', 'logo', 'banner', 'mobile', 'address', 'city', 'state', 'country', 'postal_code', 'open_at', 'close_at', 'lunch_from', 'lunch_to'
    ];

    public function getOwners()
    {
        return $this->hasMany(SalonOwnerDetail::class);
    }

}
