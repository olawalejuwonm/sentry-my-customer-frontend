<?php

namespace App;
use Jenssegers\Mongodb\Eloquent\Model;

class Transaction extends Model
{
    protected $dates = ['createdAt']; //convert Mongo Date to Carbon/DateTime

    public function customer(){
        return $this->belongsTo(Customer::class, 'customer_ref_id');
    }
}
