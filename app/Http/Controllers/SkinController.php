<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Auth;
use Illuminate\Http\Request;

class SkinController extends Controller
{
    public function main(){
        return view('main.main');
    }


    public function tomodel(){
        return view('main.tomodel');
    }
    public function uploadimage(Request $request)
    {
        $request->validate([
            'img' => 'required|image|mimes:jpg,png,webp,avif,jpeg',
        ]);
    
        $image = $request->file('img');
        $exe = $image->getClientOriginalExtension();
        $imagename = 'skin - ' . uniqid() . '.' . $exe;
        $image->move(public_path('uploads/skins'), $imagename);
    
        Image::create([
            'user_id' => Auth::id(),
            'img' => $imagename,
        ]);
    
        return redirect()->back()->with('success', 'Image uploaded successfully.');
    }
    
public function getchat(){
    return view('chat.chat');
}

}
