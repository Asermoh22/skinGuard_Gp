<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable=[
      'namecity',  
      ];

      public function governorate(){
        return $this->belongsTo(Governorate::class);
      }

      
}
