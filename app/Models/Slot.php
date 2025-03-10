<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;
    protected $fillable = ['doctor_id', 'date', 'start_time', 'end_time', 'is_booked'];

    public function doctor(){
        return $this->belongsTo(Doctor::class);
    }

    public function slot(){
        return $this->hasOne(Booking::class);
    }

    
}
