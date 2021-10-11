<?php

namespace App\Http\Controllers\API;

use App\Role;
use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Http\Resources\RoleCollection;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return new RoleCollection(Role::latest()->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name'       => 'required|string|max:255|unique:roles',
            'permission' => 'required'
        ]);

        // save role
        $role = Role::create([
            'name' => $request->input('name'),
        ]);

        // give permission to the role
        $permissions = Permission::whereIn('slug', $request->input('permission'))->get()->pluck('id')->toArray();
        $role->permissions()->sync($permissions);

        // Create activity log 
        activity()
        ->performedOn($role)
        ->causedBy(auth()->user())
        ->log("Role `{$role->name}` created");

        return $this->responseWithSuccess('Role added successfully',$role);
    }

    /**
     * Display the specified resource.
     * Get role with permission .. 
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $role = new RoleResource(Role::where('slug',$slug)->firstOrfail());
            return $this->responseWithSuccess('Role get successfully',$role);
        } catch (\Exception $e) { 
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
    
        try {
            // get associate role with slug
            $role = Role::where('slug',$slug)->first();

            // Validate data
            $request->validate([
                'name'=>'required|max:30|unique:roles,name,'.$role->id,
                'permission' =>'required',
            ]);

            // update role
            $role->name = $request['name'];
            $role->save();

            // detach permission
            $permissions = Permission::whereIn('slug', $role->permissions->pluck('slug'))->get()->pluck('id')->toArray();
            $role->permissions()->detach($permissions);

            // sync permission
            $permissions = Permission::whereIn('slug', $request->input('permission'))->get()->pluck('id')->toArray();
            $role->permissions()->sync($permissions);

            // Create activity log 
            activity()
            ->performedOn($role)
            ->causedBy(auth()->user())
            ->log("Role updated");

            return $this->responseWithSuccess('Role and permission updated successfully.',$role);

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $role = Role::where('slug', $slug)->first();
            $roleName = $role->name;
            if($role) {
                $role->delete();

                // Create activity log 
                activity()
                ->performedOn($role)
                ->causedBy(auth()->user())
                ->log("Role `{$roleName}` deleted");

                return $this->responseWithSuccess('Role deleted successfully',$role);
            }
            return $this->responseWithError('Opps! You are trying with bad request..');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
