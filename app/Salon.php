<?php

namespace App;

use Carbon\Carbon;
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
        'name', 'email', 'logo', 'banner', 'mobile',
        'address', 'city', 'state', 'country',
        'postal_code', 'lat', 'lng', 'open_at',
        'close_at', 'lunch_from', 'lunch_to'
    ];

    public function getOwners()
    {
        return $this->hasMany(SalonOwnerDetail::class);
    }

    public function getOpenAtAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
    }

    public function getCloseAtAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
    }

    public function getLunchFromAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
    }

    public function getLunchToAttribute($value)
    {
        if (!empty($value)) {
            return Carbon::createFromFormat('H:i:s', $value)->format('H:i');
        }
    }
}
