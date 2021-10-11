<?php

namespace App\Http\Controllers\API;

use App\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\TagResource;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TagResource::collection(Tag::latest()->paginate(10));
    }


    /**
     * get all tags
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceTags()
    {
        return Tag::select('slug','name')->get();
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function search($querys)
    {
        return TagResource::collection(Tag::where('name', 'like', '%' . $querys . '%')->latest()->paginate(10));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'       => 'required|string|max:255|unique:tags',
        ]);

        // save role
        $tag = Tag::create([
            'name' => $request->input('name'),
        ]);

        // Create activity log 
        activity()
        ->performedOn($tag)
        ->causedBy(auth()->user())
        ->log("Tag `{$tag->name}` created.");

        return $this->responseWithSuccess('Role added successfully',$tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // try {
        //     $team = Tag::where('slug',$slug)->firstOrfail();
        //     return $this->responseWithSuccess('Team get successfully',$team);
        // } catch (\Exception $e) { 
        //     return $this->responseWithError($e->getMessage());
        // }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {
            // get associate role with slug
            $tag = Tag::where('slug',$slug)->firstOrFail();
            $tagOldName = $tag->name;

            // Validate data
            $this->validate($request, [
                'name' => 'required|string|max:255|unique:tags,name,'.$tag->id,
            ]);

            // update user info
            $tag->name = $request->name;
            $tag->save();

            // Create activity log 
            activity()
            ->performedOn($tag)
            ->causedBy(auth()->user())
            ->log("Tag `{$tagOldName}` updated as `{$tag->name}` ");

            return $this->responseWithSuccess('Tag has been updated successfully.',new TagResource($tag));

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $slug
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        try {
            $tag = Tag::where('slug', $slug)->first();
            $tagName = $tag->name;
            $tag->delete();
            // Create activity log 
            activity()
            ->performedOn($tag)
            ->causedBy(auth()->user())
            ->log("Tag `{$tagName}` Deleted.");

            return $this->responseWithSuccess('Team deleted successfully');

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $tag_slug
     * @return \Illuminate\Http\Response
     */
    public function delete_tags(Request $request)
    {
        try {

            Tag::whereIn('slug', $request->data)->delete();
            // Create activity log 
            activity()
            ->performedOn(new Tag())
            ->causedBy(auth()->user())
            ->log("All tags Deleted");

            return $this->responseWithSuccess('Tag deleted successfully');

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
