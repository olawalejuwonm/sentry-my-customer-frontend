<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model;

class Customer extends Model
{
    protected $dates = ['createdAt']; //convert Mongo Date to Carbon/DateTime
    
    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
