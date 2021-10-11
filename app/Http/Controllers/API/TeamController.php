<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Events\TeamCreatedEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\TeamCollection;

class TeamController extends Controller
{
    /**
     * constant declear for remove duplication of image path
     */
    const PROFILE_PATH = 'img/profile/';


    /**
     * get all user which role 0 (Account Owner) and 1(Team member) for team module 
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new TeamCollection(User::where('account_role', '!=' , 2)->latest()->paginate(10));
    }


    /**
     * get all user which role 1 for team module 
     *
     * @return \Illuminate\Http\Response
     */
    public function serviceTeam()
    {
        return User::select('slug','name','profile_pic')->where('account_role', 1)->get();
    }


    /**
     * Display a listing of the resource.
     *
     */
    public function search($querys)
    {
        return new TeamCollection(User::where(function($query) use ($querys) {
                                            $query->where('name', 'like', '%' . $querys . '%')
                                            ->orWhere('email', 'like', '%' . $querys . '%');
                                        })
                                        ->where('account_role', 1)
                                        ->latest()
                                        ->paginate(10));
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
            'name'  => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'phone' => 'nullable|max:20|unique:users',
            'role'  => 'required',
        ]);


        
        try {

            if($request->profilePic){
                $name = time().'.' . explode('/', explode(':', substr($request->profilePic, 0, strpos($request->profilePic, ';')))[1])[1];
                \Image::make($request->profilePic)->save(public_path(self::PROFILE_PATH).$name);
                $request->profilePic     = $name;
            }
            
            // Create user
            $team = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => $request->password ? Hash::make($request->password) : Hash::make(123456),
                'account_role' => 1,
                'phone' => $request->phone,
                'profile_pic' => $request->profilePic,
            ]);

            //assign role to team
            $team->roles()->attach($request->role['id']);

            // mail event for new team members
            if($request->mail){
                event(new TeamCreatedEvent($team));
            }

            // Create activity log 
            activity()
                ->performedOn($team)
                ->causedBy(auth()->user())
                ->withProperties(['customProperty' => 'customValue'])
                ->log("Created team account for `{$team->name}`");
            return $this->responseWithSuccess('Team member added successfully.',$team);

        } catch (\Exception $e) { 

            return $this->responseWithError($e->getMessage());

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        try {
            $team = User::where('slug',$slug)->with('roles')->firstOrfail();
            return $this->responseWithSuccess('Team get successfully',$team);
        } catch (\Exception $e) { 
            return $this->responseWithError($e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        try {
            // get associate role with slug
            $team = User::where('slug',$slug)->firstOrFail();

            // Validate data
            $this->validate($request, [
                'name'  => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,'.$team->id,
                'phone' => 'nullable|max:20|unique:users,phone,'.$team->id,
                'role'  => 'required',
            ]);

            // check and update user profile picture
            if($request->profile_pic !=  $team->profile_pic){
                $name = time().'.' . explode('/', explode(':', substr($request->profile_pic, 0, strpos($request->profile_pic, ';')))[1])[1];
                \Image::make($request->profile_pic)->save(public_path(self::PROFILE_PATH).$name);
                $request->profile_pic   = $name;
                //delete previous image
                $userPhoto = public_path(self::PROFILE_PATH).$team->profile_pic;
                if(file_exists($userPhoto)){
                    @unlink($userPhoto);
                }
            }

            // update user info
            $team->name        =   $request->name;
            $team->email       =   $request->email;
            $team->phone       =   $request->phone;
            $team->profile_pic =   $request->profile_pic;
            if($request->password) {
               $team->password = Hash::make($request->password);
            }

            // update team member info
            $team->save();

            // update role
            $currentRole = $team->roles ? $team->roles[0]->id : null;
            if($request->role['id'] != $currentRole){
                $team->roles()->detach();
                $team->roles()->attach($request->role['id']);
            } 
            

            //send mail
            if($request->mail){
                event(new TeamCreatedEvent($team));
            }

            // Create activity log 
            activity()
            ->performedOn($team)
            ->causedBy(auth()->user())
            ->log("Updated team account for `{$team->name}`");

            return $this->responseWithSuccess('Team member updated successfully.',$team);

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
            $user = User::where('slug', $slug)->first();
            if($user) {
                //remove profile image
                if(!is_null($user->profile_pic)){
                    $userPhoto = public_path(self::PROFILE_PATH) . $user->profile_pic;
                    if(file_exists($userPhoto)){
                        @unlink($userPhoto);
                    }
                }

                $user->delete();

                // Create activity log 
                activity()
                ->performedOn($user)
                ->causedBy(auth()->user())
                ->log("`{$user->name}'s` account has been deleted.");

                return $this->responseWithSuccess('Team deleted successfully',$user);
            }
            return $this->responseWithError('Opps! You are trying with bad request..');
        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  array  $user_slug
     * @return \Illuminate\Http\Response
     */
    public function delete_teams(Request $request)
    {
        try {
            foreach($request->data as $slug) {
                $user = User::where('slug', $slug)->firstOrFail();
                //remove profile image
                if(!is_null($user->profile_pic)){
                    $userPhoto = public_path(self::PROFILE_PATH) . $user->profile_pic;
                    if(file_exists($userPhoto)){
                        @unlink($userPhoto);
                    }
                }
                $user->delete();
            }
            return $this->responseWithSuccess('Team deleted successfully');

        } catch (Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
