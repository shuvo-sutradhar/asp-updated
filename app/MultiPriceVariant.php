<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MultiPriceVariant extends Model
{

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'multi_price_id', 
        'name',
        'price',
    ];
    
}
