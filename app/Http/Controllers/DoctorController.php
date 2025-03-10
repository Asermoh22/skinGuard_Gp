<?php

namespace App\Http\Controllers;

use Auth;
use Carbon\Carbon;
use App\Models\City;
use App\Models\Slot;
use App\Models\Doctor;
use App\Models\Booking;
use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

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


    public function bookSlot(Request $request, $id)
    {
        $slot = Slot::findOrFail($id);
        $user = Auth::user();
    
        $existingBooking = Booking::where('user_id', $user->id)
                                  ->where('slot_id', $slot->id)
                                  ->first();
    
        if ($existingBooking) {
            return redirect()->back()->with('error', 'You have already booked this slot.');
        }
    
        // Mark slot as booked
        $slot->update(['is_booked' => true]);
    
        // Store booking
        Booking::create([
            'user_id' => $user->id,
            'slot_id' => $slot->id
        ]);
    
        app(EmailController::class)->sendBookingEmail($slot->id);
    
        return redirect()->back()->with('success', 'Booking successful! Check your email.');
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
    
    
    
    
