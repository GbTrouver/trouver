<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalonOwnerDetail extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'salons_id', 'first_name', 'last_name', 'email', 'image', 'mobile', 'alt_mobile',
    ];

    public function getSalon()
    {
        return $this->belongsTo(Salon::class);
    }
}
