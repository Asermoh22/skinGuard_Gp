<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    $imagename = 'skin_' . uniqid() . '.' . $exe;
    $image->move(public_path('uploads/skins'), $imagename);

// Define class mapping in English and Arabic
$classMapping = [
    0 => ["en" => "Seborrheic", "ar" => "التهاب الجلد الدهني"],
    1 => ["en" => "Melanocytic", "ar" => "وحمات ميلانينية"],
    2 => ["en" => "Melanoma", "ar" => "سرطان الجلد"],
    3 => ["en" => "Eczema", "ar" => "الأكزيما"],
    4 => ["en" => "Basal Cell", "ar" => "سرطان الخلايا القاعدية"]
];

// Send the image to the API for classification
$response = Http::attach(
    'file', 
    file_get_contents(public_path('uploads/skins/' . $imagename)), 
    $imagename
)->post('http://127.0.0.1:5000/predict');

// Get predicted class number
$predictedClass = $response->json()['predicted_class'] ?? null;

// Map predicted class to English and Arabic names
$classificationEn = $classMapping[$predictedClass]['en'] ?? 'Unknown';
$classificationAr = $classMapping[$predictedClass]['ar'] ?? 'غير معروف';

// Store only the English classification in the database
$imageEntry = Image::create([
    'user_id' => Auth::id(),
    'img' => $imagename,
    'classification' => $classificationEn // Store only English name
]);

return redirect()->route('main.tomodel')->with([
    'success' => 'Image uploaded and classified successfully.',
    'image' => $imageEntry,
    'classification_ar' => $classificationAr
]);



}
public function getchat(){
    return view('chat.chat');
}

}
