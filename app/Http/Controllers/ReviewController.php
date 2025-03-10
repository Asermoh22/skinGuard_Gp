<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request){
   $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'Rating'=> 'required|integer|min:1|max:5',
            'Review' => 'nullable|string'
        ]);


        Review::create([
            'user_id'=>Auth::user()->id,
            'doctor_id'=>$request->doctor_id,
            'Rating'=>$request->Rating
        ]);

        return redirect(route('doctors.show',$request->doctor_id));
    }
}
