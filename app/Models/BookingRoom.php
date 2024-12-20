<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class BookingRoom extends Model
{
    use HasFactory;
    protected $fillable = ['building_number','floor_number','room_number'];
    protected $appends = ['checkout_datetime'];

    public function getCheckoutDatetimeAttribute()
    {
        return Carbon::parse(($this->checkout_date.' '.$this->checkout_time))->format('d-m-Y H:i:s');
    }
}
