<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Profile;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{


  

    public function getprofile(){
        $user = Auth::user();
        $realcity = City::findOrFail($user->city); 
        
      
        return view('profile.profile',['user'=>$user,'realcity'=>$realcity]);
    }
}
