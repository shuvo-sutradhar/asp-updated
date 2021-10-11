<?php

namespace App\Http\Controllers\API;

use App\OrderSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(OrderSetting::all('key', 'value'));
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
    	$request->validate([
            'initialOrderStatus' => 'required|string|max:20',
            'revision' => 'required|max:5',
            'revisionOrderStatus' => 'required|string|max:20',
        ]);
        

    	OrderSetting::where('key', 'order.initialOrderStatus')->firstOrFail()->update(['value' => $request->initialOrderStatus]);    	
    	OrderSetting::where('key', 'order.revision')->firstOrFail()->update(['value' => (string)$request->revision]);
    	OrderSetting::where('key', 'order.revisionOrderStatus')->firstOrFail()->update(['value' => $request->revisionOrderStatus]);
        
        return $this->responseWithSuccess('Order setting updated successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
