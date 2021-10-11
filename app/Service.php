<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Service extends Model
{
    use Sluggable;
    
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'name', 
        'description', 
        'service_type', 
        'pricing_type',
        'currency',
        'review',
        'comment',
        'group_qty',
        'deadline',
        'status',
        'layout_tbl'
     ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    /**
     * The tag that belong to the service.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'service_tag');
    }   

    /**
     * The team for the service that belong to the user.
     */
    public function teams()
    {
        return $this->belongsToMany(User::class, 'service_team', 'service_id', 'team_id');
    }   

    /**
     * The team service Gallery that belong to the service.
     */
    public function serviceGallery()
    {
        return $this->hasMany(ServiceGallery::class);
    }

    /**
     * The serviceFAQ that belong to the service.
     */
    public function serviceFAQ()
    {
        return $this->hasMany(serviceFAQ::class);
    }

    /**
     * The service Requirement that belong to the service.
     */
    public function serviceRequirement()
    {
        return $this->hasOne(ServiceRequirement::class);
    }

    /**
     * The service subscription that belong to the service.
     */
    public function serviceSubscription()
    {
        return $this->hasOne(ServiceSubscription::class);
    }


    /**
     * The service Single Price that belong to the service.
     */
    public function serviceSinglePrice()
    {
        return $this->hasOne(serviceSinglePrice::class);
    }

    /**
     * Get the multi price for the service.
     */
    public function serviceMultiPrice()
    {
        return $this->hasManyThrough('App\MultiPriceVariant', 'App\ServiceMultiPrice');
    }

    // get only price
    // public function sericePrice($pricing_type)
    // {
    //     return $pricing_type == 0 ? $this->serviceSinglePrice() : $this->serviceMultiPrice() ;
    // }

}
