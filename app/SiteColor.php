<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteColor extends Model
{
    protected $fillable = [
        'color_code', 'color_name'
    ];
}
