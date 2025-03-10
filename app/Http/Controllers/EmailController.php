<?php
namespace App\Http\Controllers;

use App\Mail\welcomeemail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Booking;
use App\Models\Slot;
use App\Models\Doctor;
use Auth;

class EmailController extends Controller
{
    public function sendBookingEmail($slotId)
    {
        $user = Auth::user();
        $slot = Slot::with(['doctor.city'])->findOrFail($slotId);
        $doctor = $slot->doctor;

        // Ensure city name is properly retrieved
        $cityName = $doctor->city->namecity ? $doctor->city->namecity : 'Unknown';

        // Email details
        $toEmail = $user->email;
        $subject = "Booking Confirmation for $doctor->name";
        
        $messageData = [
            'user' => $user->name,
            'doctorName' => $doctor->name,
            'specialization' => $doctor->specialization,
            'price' => $doctor->price,
            'country' => $doctor->city->namecity, // ✅ Corrected city name retrieval
            'slotDate' => $slot->date,
        ];

        // Send email
        Mail::to($toEmail)->send(new WelcomeEmail($messageData, $subject));

        return redirect()->back()->with('success', 'Booking successful! Check your email.');
    }
}
