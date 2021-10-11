<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $userRoles = $this->roles()->with('permissions')->get();
        $roles = $userRoles->pluck('slug');
        $rolesPermissions = $userRoles->pluck('permissions')->flatten(1)->pluck('slug');
        // $userPermissions = $rolesPermissions->merge($this->permissions->pluck('slug'));

        return [
            "name" => $this->name,
            "email" => $this->email,
            "photo_url" => $this->photo_url,
            "account_role" => $this->account_role,
            "created_at" => $this->created_at,
            "roles" => $roles,
            "permissions" => $rolesPermissions,
        ];
    }
}
