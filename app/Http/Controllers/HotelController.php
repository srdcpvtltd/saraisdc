<?php

namespace App\Http\Controllers;

use App\Facades\UtilityFacades;
use App\Models\Modual;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\City;
use App\Models\State;
use App\Models\HotelProfile;
use App\Models\PoliceStation;
use Exception;
use Session;

class HotelController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function add_hotel(Type $var = null)
    {
        $user = \Auth::user();
        $countries = \DB::table('countries')->get();
        return view('frontend.pages.add-hotel', compact('countries'))->with('user',$user);
    }

    public function get_police_stations(Request $request)
    {
        $cityid = $request->city;

        $ps = PoliceStation::orderBy('desc', "ASC")->where([['city_id', $cityid]])->get();

        return response()->json(['aaData' => $ps]);
    }

    public function post_add_hotel(Request $request)
    {
        try{
            
            $this->validate($request, [
                'cmbcountry' => 'required',
                'cmbstate' => 'required',
                'cmbcity' => 'required',
                'police_station' => 'required',
            ]);
            $hotel = new HotelProfile();

            $hotel->hotel_name = $request->hotel_name;
            $hotel->manager_name = $request->manager_name;
            $hotel->owner_name = $request->owner_name;
            $hotel->manager_mobile = $request->manager_no;
            $hotel->owner_mobile = $request->owner_no;
            $hotel->address = $request->address;
            $hotel->registration_number = $request->regd_no;
            $hotel->city = $request->cmbcity;
            $hotel->user_id = Auth::id();
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

            $hotel->country = (isset($request->cmbcountry) && !empty($request->cmbcountry)) ? $request->cmbcountry : null;
            $hotel->otherCountry = (isset($request->otherCountry) && !empty($request->otherCountry)) ? $request->otherCountry : null;
            $hotel->state = (isset($request->cmbstate) && !empty($request->cmbstate)) ? $request->cmbstate : null;
            $hotel->otherState = (isset($request->otherState) && !empty($request->otherState)) ? $request->otherState : null;
            $hotel->otherCity = (isset($request->otherCity) && !empty($request->otherCity)) ? $request->otherCity : null;
            $hotel->city = (isset($request->cmbcity) && !empty($request->cmbcity)) ? $request->cmbcity : null;
            
            // Security Measures
            $hotel->baggage_scanner = (boolean)$request->bagage_radio_btn;
            $hotel->fire_detector = (boolean)$request->fire_radio_btn;
            $hotel->fire_license = $request->fire_license_no;
            $hotel->cctv = (boolean)$request->cctv_radio_btn;
            $hotel->no_of_cameras = $request->no_of_camera;
            $hotel->no_of_cameras_outside = $request->no_of_camera_outside;
            $hotel->metal_detector = (boolean)$request->metal_radio_btn;
            
            $hotel->save();
            Session::flash('message', "Hotel Added Successfully");
            return redirect('/dashboard')->with('success', "Hotel Added Successfully");
        }catch (Exception $e)
        {
            request()->session()->flash('error', $e->getMessage());
            return back()->withInput($request->all());
            
        }
    }
    public function index()
    {
        if (!file_exists(storage_path() . "/installed")) {
            header('location:install');
            die;
        } else {



            $user = User::count();
            $modual = Modual::count();
            $role = Role::count();
            $languages = count(UtilityFacades::languages());

            return view('dashboard.homepage', compact('user', 'modual', 'role', 'languages'));
        }
    }

    public function chart(Request $request)
    {

        if ($request->type == 'year') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 12; $i++) {
                $arrLable[] = Carbon::now()->subMonth($i)->format('F');
                $arrValue[Carbon::now()->subMonth($i)->format('M')] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);

            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%b") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%b") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);
            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }

        if ($request->type == 'month') {

            $arrLable = [];
            $arrValue = [];

            for ($i = 0; $i < 30; $i++) {
                $arrLable[] = date("d M", strtotime('-' . $i . ' days'));

                $arrValue[date("d-m", strtotime('-' . $i . ' days'))] = 0;
            }
            $arrLable = array_reverse($arrLable);
            $arrValue = array_reverse($arrValue);
            $t = User::select(DB::raw('DATE_FORMAT(created_at,"%d-%m") AS user_month,COUNT(id) AS usr_cnt'))
                ->where('created_at', '>', Carbon::now()->subDays(365)->toDateString())
                ->where('created_at', '<', Carbon::now()->toDateString())
                ->groupBy(DB::raw('DATE_FORMAT(created_at,"%d-%m") '))
                ->get()
                ->pluck('usr_cnt', 'user_month')
                ->toArray();

            foreach ($t as $key => $val) {
                $arrValue[$key] = $val;
            }
            $arrValue = array_values($arrValue);

            return response()->json(['lable' => $arrLable, 'value' => $arrValue], 200);
        }

        
    }
    public function post_edit_hotel($hotelId) {
        $user = \Auth::user();
        $hotel = HotelProfile::where('id',$hotelId)->where('user_id',Auth::id())->first();
        
        if($hotel){
            $city = City::where('code', $hotel->city)->first();
            $police_station = PoliceStation::where([['city_id', $hotel->city]])->orderBy('desc', "ASC")->get();
            $countries = \DB::table('countries')->get();
            return view('frontend.pages.edit-hotel')->with('countries',$countries)->with('user',$user)->with('hotel',$hotel)->with('police_station',$police_station);
        }
        return 'Edit Hotel';
    }
    public function update_edit_hotel(Request $request)
    {
        $user = \Auth::user();
        $hotel = HotelProfile::find($request->get('hotel_id'));
        $hotel->hotel_name = $request->hotel_name;
        $hotel->manager_name = $request->manager_name;
        $hotel->owner_name = $request->owner_name;
        $hotel->manager_mobile = $request->manager_no;
        $hotel->owner_mobile = $request->owner_no;
        $hotel->address = $request->address;
        $hotel->registration_number = $request->regd_no;
        $hotel->user_id = $request->user_id;
        $hotel->floors = $request->no_of_floor;
        $hotel->rooms = $request->no_of_rooms;
        $hotel->direct_employee_count = $request->direct_employee_count;
        $hotel->outsource_employee_count = $request->outsource_employee_count;
        $hotel->website = $request->website;
        $hotel->email = $request->email;
        $hotel->geo_tagging = $request->tagging_radio_btn  == 'yes' ? 1 : 0;
        $hotel->latitude = $request->txtlongitude;
        $hotel->longitude = $request->txtlatitude;
        $hotel->swimming_pool = $request->swimming_radio_btn  == 'yes' ? 1 : 0;
        $hotel->aggregator = $request->aggr_radio_btn  == 'yes' ? 1 : 0;
        $hotel->aggregator_registration = $request->agr_regno;
        $hotel->aggregator_name = $request->agr_name;
        $hotel->staff_count = $request->no_of_staf;
        $hotel->security = $request->security_radio_btn  == 'yes' ? 1 : 0;
        $hotel->security_registration = $request->security_reg_no;
        $hotel->security_name = $request->security_name;
        $hotel->banquet_hall = $request->banquet_radio_btn == 'yes' ? 1 : 0;
        $hotel->banquet_hall_count = $request->no_of_banquet;

        if(isset($request->police_station))
        {
            $hotel->police_station = (isset($request->police_station) && !empty($request->police_station)) ? $request->police_station : null;
        }

        if(isset($request->cmbcountry)){
            $hotel->country = (isset($request->cmbcountry) && !empty($request->cmbcountry)) ? $request->cmbcountry : null;
        }
        if(isset($request->otherCountry)){
            $hotel->otherCountry = (isset($request->otherCountry) && !empty($request->otherCountry)) ? $request->otherCountry : null;
        }
        if(isset($request->cmbstate)){
            $hotel->state = (isset($request->cmbstate) && !empty($request->cmbstate)) ? $request->cmbstate : null;
        }
        if(isset($request->otherState)){
            $hotel->otherState = (isset($request->otherState) && !empty($request->otherState)) ? $request->otherState : null;
        }
        if(isset($request->otherCity)){
            $hotel->otherCity = (isset($request->otherCity) && !empty($request->otherCity)) ? $request->otherCity : null;
        }
        if(isset($request->cmbcity)){
            $hotel->city = (isset($request->cmbcity) && !empty($request->cmbcity)) ? $request->cmbcity : null;
        }   
        
        // Restaurant
        $hotel->restaurant_count = $request->no_of_restaurant;
        $hotel->leased_room = $request->leased_radio_btn  == 'yes' ? 1 : 0;
        $hotel->leased_room_count = $request->no_of_leased_room;
        $hotel->has_bar = $request->bar_radio_btn  == 'yes' ? 1 : 0;
        $hotel->has_pub = $request->pub_radio_btn  == 'yes' ? 1 : 0;
        
        // Security Measures
        $hotel->baggage_scanner = $request->bagage_radio_btn == 'yes' ? 1 : 0;
        $hotel->fire_detector = $request->fire_radio_btn == 'yes' ? 1 : 0;
        $hotel->fire_license = $request->fire_license_no;
        $hotel->cctv = $request->cctv_radio_btn == 'yes' ? 1 : 0;
        $hotel->no_of_cameras = $request->no_of_camera;
        $hotel->no_of_cameras_outside = $request->no_of_camera_outside;
        $hotel->metal_detector = $request->metal_radio_btn == 'yes' ? 1 : 0;
        
        $hotel->save();
        Session::flash('message', "Hotel Update Successfully");
        if($user->id != $request->user_id){
            return redirect('/admin/hotel_report')->with('success', "Hotel Update Successfully");
        } else {
            return redirect('/dashboard')->with('success', "Hotel Update Successfully");
        }

    }

    public function show($hotal)
    {
        $hotel = HotelProfile::where('id',$hotal)->first();
     
        $user = User::where('id',$hotel->user_id)->first();
        
        $state = State::where('id', $hotel->state)->first();
        $city = City::where('id', $hotel->city)->first();
        $police_station = PoliceStation::where('id', $hotel->police_station)->first();
        $countries = \DB::table('countries')->where('id', $hotel->country)->first();
        return view('admin.hotel.detail')->with('countries',$countries)
        ->with('state',$state)->with('hotel',$hotel)->with('user',$user)
        ->with('police_station',$police_station)->with('city',$city);
    }

    public function destory($hotal)
    {
        HotelProfile::where('id',$hotal)->delete();
        $message = "Hotel removed Successfully";
        return redirect()->route('hotel_report.report')
        ->with('message', __($message));
    }

    public function admin_edit_hotel($hotelId) {

        $hotel = HotelProfile::where('id',$hotelId)->first();

        if($hotel){
            $user = User::where('id',$hotel->user_id)->first();
            $city = City::where('id', $hotel->city)->first();
            $isAdmin = 1;
            $police_station = PoliceStation::where([['city_id', $hotel->city]])->orderBy('desc', "ASC")->get();
            $countries = \DB::table('countries')->get();
            return view('frontend.pages.edit-hotel')
            ->with('isAdmin',$isAdmin)->with('countries',$countries)
            ->with('user',$user)->with('hotel',$hotel)->with('police_station',$police_station);
        } else {
            return redirect()->route('hotel_report.report');
        }
    }
}
