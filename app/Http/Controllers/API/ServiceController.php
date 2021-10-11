<?php

namespace App\Http\Controllers\API;

use App\Tag;
use App\User;
use App\Service;
use App\ServiceSinglePrice;
use App\ServiceSubscription;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ServiceResource;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ServiceResource::collection(Service::latest()->paginate(10));
    }


    /**
     * Search service
     * @return \Illuminate\Http\Response
     */
    public function search($quarries)
    {
        return ServiceResource::collection(Service::where(function($query) use ($quarries) {
                                            $query->where('name', 'like', '%' . $quarries . '%');
                                        })
                                        ->latest()
                                        ->paginate(10));
    }



    /**
     * validate input data
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function validateName(Request $request){

        $validator = validator($data = $request->all(), [
            'name'          => 'required|string|max:255|unique:services',
        ]);

        if ($validator->fails()) {
            return $this->responseWithError('Validation Error', $validator->messages());
        }
  
        return $this->responseWithSuccess('No error found.', true);
    }

    /**
     * validate input data
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function createTags($selectedTags)
    {
        $tags_id = array();
        for ($i = 0; $i < count($selectedTags); $i++) {

            if (array_key_exists("slug",$selectedTags[$i])){
                $id = Tag::where('slug', $selectedTags[$i]['slug'])->pluck('id')->first();
                if ($id) {
                    array_push($tags_id, $id);
                }
            } else {
                $tag = Tag::create([
                    'name' => $selectedTags[$i]['name']
                ]);
                array_push($tags_id, $tag->id);
            }
        }
        return $tags_id;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        // $this->validate($request, [
        //     'name'       => 'required|string|max:255|unique:services',
        // ]);

        dd($request->file('video'));

        /*
        * save role
        */
        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
            'service_type' => $request->service_type,
            'pricing_type' => $request->pricing_type,
            'currency' => $request->currency['id'],
            'review' => $request->can_review,
            'comment' => $request->can_comment,
            'group_qty' => $request->group_quantities,
            'deadline' => $request->deadline."-".$request->deadline_for,
            'status' => $request->status,
        ]);

        /*
        * Service type
        */
        if($request->service_type) {

            // service_type == 1 for requiring service
            $data = $request->requiring_service;
            $hasTrail = $data['is_trail'];
            $price = ServiceSubscription::create([
                'service_id'       => $service->id,
                'requring_price'   => $data['price'],
                'requring_period'  => $data['requring_period'],
                'requring_for'     => $data['requring_for'],
                'trail_price'      => $hasTrail ? $data['trail']['price'] : null,
                'trail_period'     => $hasTrail ? $data['trail']['period'] : null,
                'trail_for'        => $hasTrail ? $data['trail']['for']  : null,
                'requiring_status' => $data['requiring_status'],
                'request_quantity' => $data['request_quantity'],
            ]);

        } else  {

            // service_type == 0 for single service
            $price = ServiceSinglePrice::create([
                'service_id' => $service->id,
                'price'      => $request->onetime_service['price'],
                'quantity'   => $request->onetime_service['quantity'],
            ]);

        }


        /*
        * assign team memeber
        */
        if($request->teams) {
            $teams = array();
            foreach ($request->teams as $key) {
                $teams[] = $key['slug'];
            }
            $team_ids = User::whereIn('slug', $teams)->get()->pluck('id')->toArray();
            $service->teams()->attach($team_ids);
        }

        /*
        * assign tag to service
        */
        if($request->tags) {
            $tags_id = $this->createTags($request->tags);
            $service->tags()->attach($tags_id);
        }

        return $this->responseWithSuccess('Service added successfully', $service);
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
    public function destroy($slug)
    {
        //
        try {
            $service = Service::where('slug', $slug)->first();
            $serviceName = $service->name;
            $service->delete();
            // Create activity log 
            activity()
            ->performedOn($service)
            ->causedBy(auth()->user())
            ->log("Tag `{$serviceName}` Deleted.");

            return $this->responseWithSuccess('Service deleted successfully');

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $services_slug
     * @return \Illuminate\Http\Response
     */
    public function deleteServices(Request $request)
    {
        try {
            Service::whereIn('slug', $request->data)->delete();
            // Create activity log 
            activity()
            ->performedOn(new Service())
            ->causedBy(auth()->user())
            ->log("All services Deleted");
            return $this->responseWithSuccess('Service deleted successfully');

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }

}
