<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable=['user_id','slot_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function slot(){
        return $this->belongsTo(slot::class);
    }
}


