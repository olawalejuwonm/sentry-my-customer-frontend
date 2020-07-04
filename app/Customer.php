<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Customer extends Model
{
    protected $dates = ['createdAt']; //convert Mongo Date to Carbon/DateTime
    
    protected $fillable = [
        'name', 'email', 'phone_number', 'store'
    ];

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }

    public function store(){
        return $this->belongsTo(Store::class, 'store');
    }
}
