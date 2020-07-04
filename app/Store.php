<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Store extends Model
{
    protected $fillable = [
        'phone_number', 'shop_address', 'store_name', 'tagline', 'email', 'store_admin'
    ];

    public function getRouteKeyName()
    {
        return '_id';
    }
}
