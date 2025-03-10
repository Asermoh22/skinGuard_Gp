<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\City;
use App\Models\Doctor;
use Auth;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function getform()
    {
        $cities = City::all();
        return view('doctors.form', ['cities' => $cities]);
    }

    public function doctorhandel(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:150',
            'img' => 'image|mimes:jpg,png,webp,avif,jpeg',
            'city_id' => 'required|integer|exists:cities,id',
            'specialization' => 'required|string',
            'price' => 'required|numeric'
        ]);

        $imagename = 'default-doctor.jpg';

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $exe = $image->getClientOriginalExtension();
            $imagename = 'doctor-' . uniqid() . '.' . $exe;
            $image->move(public_path('uploads/doctors'), $imagename);
        }

        Doctor::create([
            'name' => $request->name,
            'city_id' => $request->city_id,
            'specialization' => $request->specialization,
            'price' => $request->price,
            'img' => $imagename
        ]);



        return redirect(route('main.main'));

    }



    public function findDoctor(Request $request) {
        $sort = $request->get('sort', 'name'); 
        $direction = $request->get('direction', 'asc'); 
    
        $doctors = Doctor::orderBy($sort, $direction)->paginate(8);
        
        return view('doctors.finddoctors', ['doctors' => $doctors]);
    }
    
    public function findDoctorsByCity(Request $request) {
        $userCityId = Auth::user()->city;
        $sort = $request->get('sort', 'name');  
        $direction = $request->get('direction', 'asc');  
    
        $doctors = Doctor::with('city')
                         ->where('city_id', $userCityId)
                         ->orderBy($sort, $direction) 
                         ->paginate(8);
    
        return view('doctors.finddoctors', ['doctors' => $doctors]);
    }

    public function show($id){

        $doctor=Doctor::findOrFail($id);
        return view('doctors.show',['doctor'=>$doctor]);
    }




    public function generateSlots($doctorId)
    {
        $doctor = Doctor::findOrFail($doctorId);
        $daysToGenerate = 3; 
        $slotDuration = 45; 
    
        for ($i = 0; $i < $daysToGenerate; $i++) {
            $date = Carbon::today()->addDays($i)->toDateString(); 
    
            $currentStartTime = Carbon::today()->addDays($i)->setTime(8, 0, 0);
            $currentEndTime = Carbon::today()->addDays($i)->setTime(10, 0, 0);
    
            while ($currentStartTime->lt($currentEndTime)) {
                Slot::updateOrCreate(
                    [
                        'doctor_id' => $doctorId,
                        'date' => $date,
                        'start_time' => $currentStartTime->format('Y-m-d H:i:s'), 
                        'end_time' => $currentStartTime->copy()->addMinutes($slotDuration)->format('Y-m-d H:i:s'),
                    ],
                    ['is_booked' => false]
                );
    
                $currentStartTime->addMinutes($slotDuration);
            }
        }
    
        return back()->with('success', 'Slots generated successfully!');
    }


    public function bookSlot(Request $request ,$id){
        $slot=Slot::findOrFail($id);

        $slot->update(['is_booked'=>true]);

        
        Booking::create([
            'user_id'=>Auth::user()->id,
            'slot_id'=>$slot->id
        ]);

        return back()->with('success', 'Slot booked successfully!');

    }


    public function cancelbooking($id)
    {
        $booking = Booking::findOrFail($id);
    
        if (Auth::id() !== $booking->user_id) {
            return redirect()->back()->with('error', 'Unauthorized action.');
        }
    
        $booking->slot->is_booked = false;
        $booking->slot->save();
    
        $booking->delete();
    
        return redirect()->back()->with('success', 'Booking canceled successfully.');
    }


       




        

    }  
    
    
    
    
