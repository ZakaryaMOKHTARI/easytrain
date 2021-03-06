<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Auth;

class MyController extends Controller
{

    public function login() {
        // C est ici que l on met le code
        return view('login');
    }

    public function register() {
        // C est ici que l on met le code
        return view('register');
    }

    public function edit(){
        return view('auth/edit');
    }

    public function update_pics(Request $request){

        // Handle the user upload of avatar
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->orientate()->save( public_path('/uploads/avatars/' . $filename ) );

            $user = Auth::user();
            $user->avatar = $filename;
            $user->save();
        }


        // Handle the user upload of bannier
        if($request->hasFile('banniere')){
            $banniere = $request->file('banniere');
            $filename = time() . '.' . $banniere->getClientOriginalExtension();
            Image::make($banniere)->orientate()->blur(40)->save( public_path('/uploads/banniere/' . $filename ) );


            $user = Auth::user();
            $user->banniere = $filename;
            $user->save();
        }

        return view('/profile', array('user' => Auth::user()) );

    }

}
