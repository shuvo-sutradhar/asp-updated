<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TeamCollection extends ResourceCollection
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
            'data' => $this->collection->transform(function ($user){
                return [
                    'id'  => $user->id,
                    'name'  => $user->name,
                    'email'  => $user->email,
                    'account_role'  => $user->account_role,
                    'phone'  => $user->phone,
                    "photo_url" => $user->photo_url,
                    'last_login_at'  => $user->last_login_at,
                    'role' => $user->roles->pluck('name'),
                    'created_at'  => $user->created_at,
                    'slug'  => $user->slug,
                ];
            })
        ];
    }
}
