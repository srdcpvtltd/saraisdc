<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelProfile extends Model
{
    use HasFactory;

    protected $appends = ['city_name','state_name','country_name'];
    protected $fillable = [
        'hotel_name',
        'manager_name',
        'owner_name',
        'manager_mobile',
        'owner_mobile',
        'address',
        'registration_number',
        'city',
        'police_station',
        'floors',
        'rooms',
        'direct_employee_count',
        'outsource_employee_count',
        'website',
        'email',
        'geo_tagging',
        'latitude',
        'longitude',
        'swimming_pool',
        'aggregator',
        'aggregator_registration',
        'aggregator_name',
        'staff_count',
        'security',
        'security_registration',
        'security_name',
        'banquet_hall',
        'banquet_hall_count',
        // Restaurant
        'restaurant_count',
        'leased_room',
        'leased_room_count',
        'has_bar',
        'has_pub',
        
        // Security Measures
        'baggage_scanner',
        'fire_detector',
        'fire_license',
        'cctv',
        'no_of_cameras',
        'no_of_cameras_outside',
        'metal_detector',
    ];

    public function getStateNameAttribute()
    {
        $stateName = State::where('id',$this->state)->first();

        return ($stateName) ? $stateName->name : '';
    }

    public function getCityNameAttribute()
    {
        $cityName = City::where('id',$this->city)->first();

        return ($cityName) ? $cityName->name : '';
    }

    public function getCountryNameAttribute()
    {
        $country = Country::where('id',$this->country)->first();

        return ($country) ? $country->name : '';
    }
}
