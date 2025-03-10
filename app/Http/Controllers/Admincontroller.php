<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;


class Admincontroller extends Controller
{

    public function index(){

        $users=User::all();
        $doctors = Doctor::with('city')->get();
        return view('dashboard.main',['users'=>$users,'doctors'=>$doctors]);
    }
    
    public function Deleteuser($id){
       $user= User::findOrFail($id);
       $user->delete();
       return redirect(route('dashboard.main'))
       ->withHeaders([
           'Cache-Control' => 'no-store, no-cache, must-revalidate, max-age=0',
           'Pragma' => 'no-cache',
           'Expires' => 'Sat, 01 Jan 2000 00:00:00 GMT'
       ]);
        }
}
