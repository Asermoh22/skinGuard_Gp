<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable=[
        'user_id','img','classification'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
