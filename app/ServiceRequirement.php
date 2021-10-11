<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceRequirement extends Model
{
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'service_id', 
        'data',
    ];


    //Relation with service
    public function service()
    {
    	return $this->belongsTo(Service::class,'service_id');
    }

}
