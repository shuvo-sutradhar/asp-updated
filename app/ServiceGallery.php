<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceGallery extends Model
{
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'service_id', 
        'type', 
        'name'
    ];

}
