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
        return \view('user.profile');
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

            // dd(public_path() . '/images/uploads/user/' . $user->image_url);

            if(file_exists(public_path() . '/images/uploads/user/' . $user->image_url)) {
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

    public function current()
    {
        return Auth::user();
    }
}
