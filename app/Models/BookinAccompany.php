<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookinAccompany extends Model
{
    use HasFactory;
    protected $table = 'booking_accompanies';
    protected $fillable = ['guest_name','gender','age','relation'];

}
