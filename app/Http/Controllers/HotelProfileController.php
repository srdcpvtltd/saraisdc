<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHotelProfileRequest;
use App\Http\Requests\UpdateHotelProfileRequest;
use App\Models\HotelProfile;

class HotelProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function get_police_stations(Request $request)
    {
        $code = $request->city;

        $city = City::where([['code', $code]])->first();

        $ps = PoliceStation::where([['city_id', $city->id]])->orderBy('desc', "ASC")->get();

        return response()->json(['aaData' => $ps]);
    }
   
    public function post_add_hotel(Request $request)
    {
    
        $hotel = new HotelProfile();

        $hotel->hotel_name = $request->hotel_name;
        $hotel->manager_name = $request->manager_name;
        $hotel->owner_name = $request->owner_name;
        $hotel->manager_mobile = $request->manager_no;
        $hotel->owner_mobile = $request->owner_no;
        $hotel->address = $request->address;
        $hotel->registration_number = $request->regd_no;
        $hotel->city = $request->cmbcity;
        $hotel->police_station = $request->police_station;
        $hotel->floors = $request->no_of_floor;
        $hotel->rooms = $request->no_of_rooms;
        $hotel->direct_employee_count = $request->direct_employee_count;
        $hotel->outsource_employee_count = $request->outsource_employee_count;
        $hotel->website = $request->website;
        $hotel->email = $request->email;
        $hotel->geo_tagging = (boolean)$request->tagging_radio_btn;
        $hotel->latitude = $request->txtlongitude;
        $hotel->longitude = $request->txtlatitude;
        $hotel->swimming_pool = (boolean)$request->swimming_radio_btn;
        $hotel->aggregator = (boolean)$request->aggr_radio_btn;
        $hotel->aggregator_registration = $request->agr_regno;
        $hotel->aggregator_name = $request->agr_name;
        $hotel->staff_count = $request->no_of_staf;
        $hotel->security = (boolean)$request->security_radio_btn;
        $hotel->security_registration = $request->security_reg_no;
        $hotel->security_name = $request->security_name;
        $hotel->banquet_hall = (boolean)$request->banquet_radio_btn;
        $hotel->banquet_hall_count = $request->no_of_banquet;
        // Restaurant
        $hotel->restaurant_count = $request->no_of_restaurant;
        $hotel->leased_room = (boolean)$request->leased_radio_btn;
        $hotel->leased_room_count = $request->no_of_leased_room;
        $hotel->has_bar = (boolean)$request->bar_radio_btn;
        $hotel->has_pub = (boolean)$request->pub_radio_btn;
        
        // Security Measures
        $hotel->baggage_scanner = (boolean)$request->bagage_radio_btn;
        $hotel->fire_detector = (boolean)$request->fire_radio_btn;
        $hotel->fire_license = $request->fire_license_no;
        $hotel->cctv = (boolean)$request->cctv_radio_btn;
        $hotel->no_of_cameras = $request->no_of_camera;
        $hotel->no_of_cameras_outside = $request->no_of_camera_outside;
        $hotel->metal_detector = (boolean)$request->metal_radio_btn;
        
        $hotel->save();
        $rules = [
    'cmbcity' => 'required'
];

        return redirect('add-hotel')->with('success', "Hotel Added Successfully");
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreHotelProfileRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreHotelProfileRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function show(HotelProfile $hotelProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(HotelProfile $hotelProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateHotelProfileRequest  $request
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateHotelProfileRequest $request, HotelProfile $hotelProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\HotelProfile  $hotelProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(HotelProfile $hotelProfile)
    {
        //
    }
}
