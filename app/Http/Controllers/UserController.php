<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

// you can use auth model for examlple-> Auth::user()
use Illuminate\Support\Facades\Auth;
// import croppa to change uploaded images
use Croppa;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $profile_id = $id;
        return \view('user.profile', \compact('profile_id'));
    }

    public function getProfile(Request $request)
    {
        $logged_user_id = Auth::id();
        $user = User::with('user_followers')
            ->findOrFail($request->input('profile_id'));
        
        
        return [
            'user' => $user,
            'logged_user_id' => $logged_user_id
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
    public function update(Request $request)
    {
        $user = User::findOrFail($request->input('user_id'));

        if($request->file('file')){

            // dd($user->image_url);

            if($user->image_url) {
                $path = public_path() . '/images/uploads/user/' . $user->image_url;
                unlink($path);
            }

            $newFileName = md5(time()) . '.' . $request->file('file')->extension();
            $request->file('file')->move(public_path('/images/uploads/user'), $newFileName);    
            $user->image_url = $newFileName;
        }

        if ($request->input('bio')) {
            $user->bio = $request->input('bio');
        }
        
        $user->save();

        
        return ['user' => $user];




        // try with the croppa but not successful
        // Croppa::render(Croppa::url('/images/uploads/' . $newFileName, 600, 600, ['resize']));
    }


    public function follow(Request $request)
    {
        // this function to_follow is from USER MODEL
        // public function to_follow()
        // {
        //     //'current_user_id' is 'logged_user_id' and 'user_id' is 'profile_id'
        //     return $this->belongsToMany('App\User', 'followers', 'current_user_id', 'user_id');
        // }
        

        //find users in the game 
        $profile_id = $request->input('profile_id');
        $logged_user_id = Auth::user();
        //attach them
        $logged_user_id->to_follow()->attach($profile_id);
        //send to the profile page updatee version of friends
        $arr_of_friends = User::findOrFail($profile_id)->user_followers;
        return $arr_of_friends;
        
    }

    public function unfollow(Request $request)
    {
        //find users in the game 
        $profile_id = $request->input('profile_id');
        $logged_user_id = Auth::user();
        //attach them
        $logged_user_id->to_follow()->detach($profile_id);
        //send to the profile page updatee version of friends
        $arr_of_friends = User::findOrFail($profile_id)->user_followers;
        return $arr_of_friends;
        
    }

    public function tofollow(Request $request)
    {
        //find users in the game 
        $profile_id = $request->input('profile_id');
        //send to the profile page updatee version of friends
        $to_follow_arr = User::findOrFail($profile_id)
            ->to_follow()
            ->orderBy('id')
            ->limit(2)
            ->get();
        return $to_follow_arr;
        
    }

    public function activitybox(Request $request)
    {
        //find profile user
        $profile_id = $request->input('profile_id');

        $numOfrecipes = count(User::findOrFail($profile_id)->recipes);
        $numOfcomments = count(User::findOrFail($profile_id)->comments);

        return [$numOfrecipes, $numOfcomments];
        
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
