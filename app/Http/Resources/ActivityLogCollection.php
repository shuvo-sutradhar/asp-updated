<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ActivityLogCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function ($log){
                return [
                    'id'  => $log->id,
                    'description'  => $log->description,
                    'created_at'  => $log->created_at,
                    'causer'  => $log->causer ? $log->causer->name : 'Unknown',
                ];
            })
        ];
    }
}
