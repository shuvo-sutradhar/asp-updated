<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceSubscription extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'service_id', 
        'requring_price',
        'requring_period',
        'requring_for',
        'trail_price',
        'trail_period',
        'trail_for',
        'requiring_status',
        'request_quantity',
    ];
}
