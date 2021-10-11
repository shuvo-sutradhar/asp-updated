<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;

class UserController extends Controller
{
    /**
     * Get authenticated user.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function current(Request $request)
    {
        return new UserResource($request->user());
        //return response()->json($request->user());
    }
}
