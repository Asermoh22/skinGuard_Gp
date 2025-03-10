<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $fillable=[
        'name','img','city_id','specialization','price'
    ];

    public function city(){
        return $this->belongsTo(City::class);
      }

      public function slots(){
        return $this->hasMany(Slot::class);
      }

      public function Reviews(){
        return $this->hasMany(Review::class);
      }

      public function averageRating()
{
    return $this->reviews()->avg('Rating') ?? 0;  
}

   
}
