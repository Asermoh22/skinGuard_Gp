<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use Auth;
use Hash;
use Str;
use App\Models\City;
use App\Models\Governorate;


use Laravel\Socialite\Facades\Socialite;


class Authcontroller extends Controller
{

    public function getCitiesByGovernorate($governorateId){
        $cities = City::where('governorate_id', $governorateId)->get();
        return response()->json($cities);
    }
    public function Register()
    {
        $cities = City::all();

        return view('auth.register', ['cities' => $cities]);
    }

    public function handelregister(Request $request)
    {
        $request->validate([
            'name' => "required|string|max:150",
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|max:250',
            'age' => 'required|numeric ',
            'city' => 'required'

        ]);

        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        $age = $request->age;
        $city = $request->city;

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'age' => $age,
            'city' => $city,
            'access_token' => Str::random(50)
        ]);

        Auth::login($user);

        return redirect(route('main.main'));

    }




    public function Login()
    {
        return view('auth.login');
    }

    public function handellogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|max:150',
            'password' => 'required|string|max:250',
        ]);

        $cord = $request->only('email', 'password');

        if (Auth::attempt($cord)) {
            return redirect(route('main.main'));
        } else {
            return back()->with('error', 'You don’t have an account.');
        }
    }






    public function redirectgoog()
    {
        return Socialite::driver('google')->redirect();
    }


    public function callbackgoog()
    {
        $user = Socialite::driver('google')->user();
        // dd($user);

        $name = $user->getName();
        $email = $user->getEmail();
        $otoken = $user->token;

        $alreadyuser = User::where('email', '=', $email)->first();
        if ($alreadyuser) {
            Auth::login($alreadyuser);
        } else {
            $newuser = User::create([
                'name' => $name,
                'email' => $email,
                'age' => 21,
                'city' => 1,
                'password' => Hash::make(Str::random(16)),
                'Oauth_token' => $otoken,
            ]);
            Auth::login($newuser);
        }

        return redirect(route('main.main'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('auth.login'));
    }

















}




