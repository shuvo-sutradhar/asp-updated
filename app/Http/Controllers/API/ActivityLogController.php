<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\ActivityLogCollection;

class ActivityLogController extends Controller
{

    /**
     * Display all activity log
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ActivityLogCollection(Activity::latest()->paginate(10));
    }

    /**
     * Display all activity log
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Activity::where('id',$id)->delete();
    }

    /**
     * Display all activity log
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        $result = Activity::truncate();
        return $this->responseWithSuccess('Team deleted successfully', $result);
    }
}
