<?php

namespace App\Http\Controllers\API;

use App\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PermissionController extends Controller
{
    //
    public function index()
    {
        return Permission::all()->groupBy('guard_name');
    }


    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255|unique:roles'
        ]);
        
        return Permission::create($request->all());
    }
}
