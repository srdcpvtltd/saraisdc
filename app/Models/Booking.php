<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Booking extends Model
{
    use HasFactory;
    protected $appends = ['arrival_datetime'];

    public function getArrivalDatetimeAttribute()
    {
        return Carbon::parse(($this->arrival_date.' '.$this->arrival_time))->format('d-m-Y H:i:s');
    }

    public function rooms() {
        return $this->hasMany(BookingRoom::class);
    }

    public function accompanies() {
        return $this->hasMany(BookinAccompany::class);
    }
    public function hotelProfile() {
        return $this->belongsTo(HotelProfile::class,'hotel_id');
    }
    public function nationalityName() {
        return $this->belongsTo(Country::class,'nationality');
    }

    public function country() {
        return $this->belongsTo(Country::class,'country_id');
    }
    public function state() {
        return $this->belongsTo(State::class,'state_id');
    }
    public function city() {
        return $this->belongsTo(City::class,'city_id');
    }
    public function p_country() {
        return $this->belongsTo(Country::class,'p_country_id');
    }
    public function p_state() {
        return $this->belongsTo(State::class,'p_state_id');
    }
    public function p_city() {
        return $this->belongsTo(City::class,'p_city_id');
    }
}
