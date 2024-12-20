<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Message;
use App\Models\Query;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
use Response;
use App\Models\HotelProfile;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $inputs = [];
        $sql = Booking::with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
                ->where('user_id',Auth::id())->orderBy('created_at','DESC');
//        dd($sql->get());
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }
        if($request->get('gender') != ''){
            $sql->where('gender',$request->get('gender'));
            $inputs['gender'] = $request->get('gender');
        }
        if($request->get('country') != ''){
            $sql->where('country_id',$request->get('country'));
            $inputs['country'] = $request->get('country');
        }
        $states = [];
        if($request->get('state') != ''){
            $sql->where('state_id',$request->get('state'));
            $inputs['state'] = $request->get('state');
            $states = \App\Models\State::where('id',$request->get('state'))->get();
        }
        $cities = [];
        if($request->get('city') != ''){
            $sql->where('city_id',$request->get('city'));
            $inputs['city'] = $request->get('city');
            $cities = \App\Models\City::where('id',$request->get('city'))->get();
        }
        if($request->get('nationality') != ''){
            $sql->where('nationality',$request->get('nationality'));
            $inputs['nationality'] = $request->get('nationality');
        }
        if($request->get('transport') != ''){
            $sql->where('transport',$request->get('transport'));
            $inputs['transport'] = $request->get('transport');
        }
        if($request->get('status') != ''){
            $status = ($request->get('status') == 'in') ? 0 : 1;
            $sql->whereHas('rooms', function($q) use ($status){
                $q->where('status',$status);
            });
            $inputs['status'] = $request->get('status');
        }

        $bookings = $sql->paginate(20);
        $countries = \DB::table('countries')->get();
        return view('guest.report.simpleReport', compact('countries','bookings','inputs','states','cities'));
    }

    public function export(Request $request){
        $inputs = [];
        $sql = Booking::with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
                ->where('user_id',Auth::id())->orderBy('created_at','DESC');
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }
        if($request->get('gender') != ''){
            $sql->where('gender',$request->get('gender'));
            $inputs['gender'] = $request->get('gender');
        }
        if($request->get('country') != ''){
            $sql->where('country_id',$request->get('country'));
            $inputs['country'] = $request->get('country');
        }
        $states = [];
        if($request->get('state') != ''){
            $sql->where('state_id',$request->get('state'));
            $inputs['state'] = $request->get('state');
            $states = \App\Models\State::where('id',$request->get('state'))->get();
        }
        $cities = [];
        if($request->get('city') != ''){
            $sql->where('city_id',$request->get('city'));
            $inputs['city'] = $request->get('city');
            $cities = \App\Models\City::where('id',$request->get('city'))->get();
        }
        if($request->get('nationality') != ''){
            $sql->where('nationality',$request->get('nationality'));
            $inputs['nationality'] = $request->get('nationality');
        }
        if($request->get('transport') != ''){
            $sql->where('transport',$request->get('transport'));
            $inputs['transport'] = $request->get('transport');
        }

        if($request->get('status') != ''){
            $status = ($request->get('status') == 'in') ? 0 : 1;
            $sql->whereHas('rooms', function($q) use ($status){
                $q->where('status',$status);
            });
            $inputs['status'] = $request->get('status');
        }

        $bookings = $sql->get();


        $fileName = 'bookings.csv';

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );
        $filename =  public_path("files/bookings.csv");
        $handle = fopen($filename, 'w');

        $columns = array("Hotel name","Hotel Address","Guest name","Mobile Number","Email","Guest From","Age","Gender","nationality","Address",
            "Lane","Country","State","Dist","Pin","Mean Of Transport","Number Of Children","Number Of Adults","Extra Guest Name",
            "Whom To Visit","Host Name","Host Mobile Number","Remarks","Arrival Date","In Time","Out Time","Duration","Status");
        fputcsv($handle, $columns);





            foreach($bookings as $row){
                $arr = [];
                $arr[] = (isset($row->hotelProfile) && isset($row->hotelProfile->hotel_name)) ? $row->hotelProfile->hotel_name : '';
                $arr[] = (isset($row->hotelProfile) && isset($row->hotelProfile->address)) ? $row->hotelProfile->address : '';
                $arr[] = $row->gues_name;
                $arr[] = $row->mobile_number;
                $arr[] = $row->email_id;
                $arr[] = $row->arrived_from;
                $arr[] = $row->age;
                $arr[] = $row->gender;
                $arr[] = (isset($row->nationalityName)) ? $row->nationalityName->name : '';
                $arr[] = $row->house_number .' '.$row->land_mark;
                $arr[] = $row->lane;
                $arr[] = (isset($row->country)) ? $row->country->name : '';
                $arr[] = (isset($row->state)) ? $row->state->name : '';
                $arr[] = (isset($row->city)) ? $row->city->name : '';
                $arr[] = $row->pin;
                $arr[] = $row->transport;
                $arr[] = $row->accompany_children;
                $arr[] = $row->accompany_adult;
                $guestName = [];
                foreach($row->accompanies as $acc){
                    $guestName[] = $acc->guest_name;
                }
                $arr[] = implode(', ',$guestName);
                $arr[] = $row->whom_to_visit;
                $arr[] = "Host Name";
                $arr[] = "Host Mobile Number";
                $arr[] = $row->remarks;
                $arr[] = $row->arrival_date;
                $arr[] = $row->arrival_time;
                $rooms = [];
                    if($row->rooms){
                        foreach($row->rooms as $room){
                            $rooms[] = $room->checkout_date != '' ? $room->checkout_date : 'occupy';
                        }
                    }
                              $rooms = [];
                if($row->rooms){
                        foreach($row->rooms as $room){
                            $rooms[] = $room->checkout_time != '' ? $room->checkout_time : 'occupy';
                        }
                    }
                $arr[] = implode(', ',$rooms);
                $arr[] = "Duration";
                $arr[] = implode(', ',$rooms);

                fputcsv($handle, $arr);
            }
            fclose($handle);
        return Response::download($filename, "bookings.csv", $headers);

    }

    public function suspicious_checkins(Request $request) {
        $inputs = [];
        $sql = Booking::where('suspicious', 1)->with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
            ->orderBy('created_at','DESC');
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d 00:00:00');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d 23:59:59'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }
        //dd($inputs);
        $bookings = $sql->paginate(20);
        //dd($bookings);
        $countries = \DB::table('countries')->get();
        $police_stations = \DB::table('police_stations')->get();

        $ageArr = \DB::table('bookings')->groupBy('age')->orderBy('age','ASC')->pluck('age');

        return view('admin.report.SuspiciousCheckIn', compact('bookings'));
    }

    public function messages(Request $request) {
        $messages = Message::orderBy('created_at','DESC')->paginate(20);

        foreach ($messages->items() as $item) {
            $date_timestamp = strtotime($item->created_at);
            $formatted_date_timestamp = date('D M d h:i A', $date_timestamp);
            $item['datetime'] = $formatted_date_timestamp;
        }

        return view('admin.report.messages', compact('messages'));
    }

    public function queries(Request $request) {
        $queries = Query::orderBy('created_at','DESC')->paginate(20);

        foreach ($queries->items() as $item) {
            $date_timestamp = strtotime($item->created_at);
            $formatted_date_timestamp = date('D M d h:i A', $date_timestamp);
            $item['datetime'] = $formatted_date_timestamp;
            $hotel_name = HotelProfile::where('id', $item->hotel_id)->value('hotel_name');
            $item['hotel_name'] = $hotel_name;
        }

        return view('admin.report.queries', compact('queries'));
    }

    public function guest_queries(Request $request) {
        $user = Auth::user();
        $hotel_id = HotelProfile::where('user_id', $user->id)->value('id');
        $queries = Query::where('hotel_id', $hotel_id)->orderBy('created_at','DESC')->paginate(20);
        foreach ($queries->items() as $item) {
            $date_timestamp = strtotime($item->created_at);
            $formatted_date_timestamp = date('D M d h:i A', $date_timestamp);
            $item['datetime'] = $formatted_date_timestamp;
        }

        return view('guest.report.sent_queries', compact('queries'));
    }

    public function create_query() {
        return view('guest.report.create_query');
    }

    public function store_query(Request $request) {
        $user = Auth::user();

        $query = new Query();
        $query->hotel_id = HotelProfile::where('user_id', $user->id)->value('id');
        $query->subject = $request->subject;
        $query->message = $request->message;
        $query->save();

        return redirect()->route('guest.queries');
    }

    public function resolve_query($id) {
        $query = Query::find($id);
        $query->status = 1;
        $query->save();
        return $id;
    }

    public function create_message() {
        return view('admin.report.create_message');
    }

    public function store_message(Request $request) {
        $message = new Message();
        $message->subject = $request->subject;
        $message->message = $request->message;
        $message->save();

        return redirect()->route('messages');
    }

    public function irregular_checkin(Request $request) {

        $inputs = [];
        $sql = Booking::with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
            ->orderBy('created_at','DESC');
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }

        $booked_hotels = $sql->pluck('hotel_id');

        $sql = HotelProfile::whereNotIn('id', $booked_hotels)->orderBy('created_at','DESC');

        $cities = \DB::table('cities')->whereNotNull('code')->get();

        $hotels = $sql->paginate(20);
        $police_stations = \DB::table('police_stations')->get();

        return view('admin.report.IrregularCheckIn', compact('hotels', 'cities', 'police_stations'));
    }

    public function adminindex(Request $request)
    {
        $inputs = [];
        $sql = Booking::with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
                ->orderBy('created_at','DESC');
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }
        if($request->get('gender') != ''){
            $sql->where('gender',$request->get('gender'));
            $inputs['gender'] = $request->get('gender');
        }
        if($request->get('country') != ''){
            $sql->where('country_id',$request->get('country'));
            $inputs['country'] = $request->get('country');
        }
        $states = [];
        if($request->get('state') != ''){
            $sql->where('state_id',$request->get('state'));
            $inputs['state'] = $request->get('state');
            $states = \App\Models\State::where('id',$request->get('state'))->get();
        }
        $cities = \DB::table('cities')->get();
        if($request->get('city') != ''){
            $sql->where('city_id',$request->get('city'));
            $inputs['city'] = $request->get('city');
            $cities = \App\Models\City::where('id',$request->get('city'))->get();
        }
        if($request->get('nationality') != ''){
            $sql->where('nationality',$request->get('nationality'));
            $inputs['nationality'] = $request->get('nationality');
        }
        if($request->get('transport') != ''){
            $sql->where('transport',$request->get('transport'));
            $inputs['transport'] = $request->get('transport');
        }
        if($request->get('gues_name') != ''){
            $sql->where('gues_name',$request->get('gues_name'));
            $inputs['gues_name'] = $request->get('gues_name');
        }

        if($request->get('status') != ''){
            $status = ($request->get('status') == 'in') ? 0 : 1;
            $sql->whereHas('rooms', function($q) use ($status){
                $q->where('status',$status);
            });
            $inputs['status'] = $request->get('status');
        }

        if($request->get('toAge') != '' && $request->get('fromAge') != ''){

            $sql->whereBetween('age',[$request->get('fromAge'), $request->get('toAge')]);
            $inputs['fromAge'] = $request->get('fromAge');
            $inputs['toAge'] = $request->get('toAge');
        } else {
            if($request->get('fromAge') != '' ) {
                $sql->where('age >= ',$request->get('fromAge'));
                $inputs['fromAge'] = $request->get('fromAge');
            }

            if($request->get('toAge') != '' ) {
                $sql->where('age <= ',$request->get('toAge'));
                $inputs['toAge'] = $request->get('toAge');
            }
        }
        $bookings = $sql->paginate(20);
        $countries = \DB::table('countries')->get();
        $police_stations = \DB::table('police_stations')->get();

        $ageArr = \DB::table('bookings')->groupBy('age')->orderBy('age','ASC')->pluck('age');

        return view('admin.report.simpleReport', compact('countries','bookings','inputs','states','cities','police_stations','ageArr'));
    }

    public function adminexport(Request $request){
        $inputs = [];
        $sql = Booking::with(['rooms','accompanies','nationalityName','country','state','city','hotelProfile'])
                ->orderBy('created_at','DESC');
        if($request->get('searchFrom') != '' || $request->get('searchTo') != ''){
            if($request->get('searchFrom') != '' && $request->get('searchTo') != ''){
                $start_date = $request->get('searchFrom');
                $unix_start_date = strtotime($start_date);
                $end_date = $request->get('searchTo');
                $unix_end_date = strtotime($end_date);
                $carbonstartParse = Carbon::createFromTimestamp($unix_start_date)->format('Y-m-d');
                $carbonendParse = Carbon::createFromTimestamp($unix_end_date)->format('Y-m-d').' 23:59:59';
//                dd($carbonendParse);
                $sql->whereBetween('created_at',[$carbonstartParse.' 00:00:00',$carbonendParse]);
//                $sql->whereBetween('created_at',['2022-05-13 00:00:00','2022-05-14 23:59:59']);
                $inputs['searchFrom'] = $request->get('searchFrom');//Carbon::now()->startOfDay();
                $inputs['searchTo'] = $request->get('searchTo'); //Carbon::now()->endOfDay();
            }
        }else{
            $inputs['searchFrom'] = date('Y-m-d');//Carbon::now()->startOfDay();
            $inputs['searchTo'] = date('Y-m-d'); //Carbon::now()->endOfDay();
            $sql->whereBetween('created_at',[$inputs['searchFrom'],$inputs['searchTo']]);
        }
        if($request->get('gender') != ''){
            $sql->where('gender',$request->get('gender'));
            $inputs['gender'] = $request->get('gender');
        }
        if($request->get('country') != ''){
            $sql->where('country_id',$request->get('country'));
            $inputs['country'] = $request->get('country');
        }
        $states = [];
        if($request->get('state') != ''){
            $sql->where('state_id',$request->get('state'));
            $inputs['state'] = $request->get('state');
            $states = \App\Models\State::where('id',$request->get('state'))->get();
        }
        $cities = [];
        if($request->get('city') != ''){
            $sql->where('city_id',$request->get('city'));
            $inputs['city'] = $request->get('city');
            $cities = \App\Models\City::where('id',$request->get('city'))->get();
        }
        if($request->get('nationality') != ''){
            $sql->where('nationality',$request->get('nationality'));
            $inputs['nationality'] = $request->get('nationality');
        }
        if($request->get('transport') != ''){
            $sql->where('transport',$request->get('transport'));
            $inputs['transport'] = $request->get('transport');
        }

        if($request->get('status') != ''){
            $status = ($request->get('status') == 'in') ? 0 : 1;
            $sql->whereHas('rooms', function($q) use ($status){
                $q->where('status',$status);
            });
            $inputs['status'] = $request->get('status');
        }

        $bookings = $sql->get();


        $fileName = 'bookings.csv';

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=download.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );
        $filename =  public_path("files/bookings.csv");
        $handle = fopen($filename, 'w');

        $columns = array("Hotel name","Hotel Address","Guest name","Mobile Number","Email","Guest From","Age","Gender","nationality","Address",
            "Lane","Country","State","Dist","Pin","Mean Of Transport","Number Of Children","Number Of Adults","Extra Guest Name",
            "Whom To Visit","Host Name","Host Mobile Number","Remarks","Arrival Date","In Time","Out Time","Duration","Status");
        fputcsv($handle, $columns);





            foreach($bookings as $row){
                $arr = [];
                $arr[] = (isset($row->hotelProfile) && isset($row->hotelProfile->hotel_name)) ? $row->hotelProfile->hotel_name : '';
                $arr[] = (isset($row->hotelProfile) && isset($row->hotelProfile->address)) ? $row->hotelProfile->address : '';
                $arr[] = $row->gues_name;
                $arr[] = $row->mobile_number;
                $arr[] = $row->email_id;
                $arr[] = $row->arrived_from;
                $arr[] = $row->age;
                $arr[] = $row->gender;
                $arr[] = (isset($row->nationalityName)) ? $row->nationalityName->name : '';
                $arr[] = $row->house_number .' '.$row->land_mark;
                $arr[] = $row->lane;
                $arr[] = (isset($row->country)) ? $row->country->name : '';
                $arr[] = (isset($row->state)) ? $row->state->name : '';
                $arr[] = (isset($row->city)) ? $row->city->name : '';
                $arr[] = $row->pin;
                $arr[] = $row->transport;
                $arr[] = $row->accompany_children;
                $arr[] = $row->accompany_adult;
                $guestName = [];
                foreach($row->accompanies as $acc){
                    $guestName[] = $acc->guest_name;
                }
                $arr[] = implode(', ',$guestName);
                $arr[] = $row->whom_to_visit;
                $arr[] = "Host Name";
                $arr[] = "Host Mobile Number";
                $arr[] = $row->remarks;
                $arr[] = $row->arrival_date;
                $arr[] = $row->arrival_time;
                $rooms = [];
                    if($row->rooms){
                        foreach($row->rooms as $room){
                            $rooms[] = $room->checkout_date != '' ? $room->checkout_date : 'occupy';
                        }
                    }
                $arr[] = implode(', ',$rooms);
                $arr[] = "Duration";
                $arr[] = implode(', ',$rooms);

                fputcsv($handle, $arr);
            }
            fclose($handle);
        return Response::download($filename, "bookings.csv", $headers);

    }

    public function hotel_report(Request $request)
    {
        $inputs = [];
        $sql = HotelProfile::orderBy('created_at','DESC');

        $cities = \DB::table('cities')->whereNotNull('code')->get();
        if($request->get('city') != ''){
            $sql->where('city',$request->get('city'));
            $inputs['city'] = $request->get('city');
        }
        if($request->get('police_station') != ''){
            $sql->where('police_station',$request->get('police_station'));
            $inputs['police_station'] = $request->get('police_station');
        }

        if($request->get('search') != '') {
            $searchQuery = $request->get('search');
            $sql->where(function ($query) use ($searchQuery) {
                $query->where('hotel_name', 'LIKE', '%'.$searchQuery.'%')->orWhere('manager_name', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('owner_name', 'LIKE', '%'.$searchQuery.'%')->orWhere('manager_mobile', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('owner_mobile', 'LIKE', '%'.$searchQuery.'%')->orWhere('address', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('registration_number', 'LIKE', '%'.$searchQuery.'%');
            });

            $inputs['search'] = $searchQuery;
        }

        $hotels = $sql->paginate(20);
        $police_stations = \DB::table('police_stations')->get();

        return view('admin.report.HotelReport', compact('hotels','inputs','cities','police_stations'));
    }

    public function hotel_reportexport(Request $request){
        $sql = HotelProfile::orderBy('created_at','DESC');

        $cities = \DB::table('cities')->whereNotNull('code')->get();
        if($request->get('city') != ''){
            $sql->where('city',$request->get('city'));
            $inputs['city'] = $request->get('city');
        }
        if($request->get('police_station') != ''){
            $sql->where('police_station',$request->get('police_station'));
            $inputs['police_station'] = $request->get('police_station');
        }
        $hotels = $sql->get();

        $fileName = 'hotels.csv';

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=hotels.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );
        $filename =  public_path("files/hotels.csv");
        $handle = fopen($filename, 'w');

        $columns = array("Hotel name","Manage Name","Manage Mobile Number","Email","Owner Name","Ownere Mobile Number","hotel Address","registration","city","police Station",
            "Floor","Rooms","Direct Employee","OurSource Employee","Website");
        fputcsv($handle, $columns);
            foreach($hotels as $row){
                $arr = [];
                $arr[] = $row->hotel_name;
                $arr[] = $row->manage_name;
                $arr[] = $row->manage_mobile;
                $arr[] = $row->email;
                $arr[] = $row->owner_name;
                $arr[] = $row->owner_mobile;
                $arr[] = $row->address;
                $arr[] = $row->registration_number;
                $arr[] = $row->city_name;
                $arr[] = $row->police_station;
                $arr[] = $row->floors;
                $arr[] = $row->rooms;
                $arr[] = $row->direct_employee_count;
                $arr[] = $row->outsource_employee_count;
                $arr[] = $row->website;
                fputcsv($handle, $arr);
            }
            fclose($handle);
        return Response::download($filename, "hotels.csv", $headers);

    }
    public function viewer_report(Request $request)
    {
        $inputs = [];
        $sql = HotelProfile::orderBy('created_at','DESC');

        $cities = \DB::table('cities')->whereNotNull('code')->get();
        if($request->get('city') != ''){
            $sql->where('city',$request->get('city'));
            $inputs['city'] = $request->get('city');
        }
        if($request->get('police_station') != ''){
            $sql->where('police_station',$request->get('police_station'));
            $inputs['police_station'] = $request->get('police_station');
        }

        if($request->get('search') != '') {
            $searchQuery = $request->get('search');
            $sql->where(function ($query) use ($searchQuery) {
                $query->where('hotel_name', 'LIKE', '%'.$searchQuery.'%')->orWhere('manager_name', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('owner_name', 'LIKE', '%'.$searchQuery.'%')->orWhere('manager_mobile', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('owner_mobile', 'LIKE', '%'.$searchQuery.'%')->orWhere('address', 'LIKE', '%'.$searchQuery.'%')
                ->orWhere('registration_number', 'LIKE', '%'.$searchQuery.'%');
            });

            $inputs['search'] = $searchQuery;
        }

        $hotels = $sql->paginate(20);
        $police_stations = \DB::table('police_stations')->get();

        return view('admin.report.ViewerReport', compact('hotels','inputs','cities','police_stations'));
    }

    public function viewer_reportexport(Request $request){
        $sql = HotelProfile::orderBy('created_at','DESC');

        $cities = \DB::table('cities')->whereNotNull('code')->get();
        if($request->get('city') != ''){
            $sql->where('city',$request->get('city'));
            $inputs['city'] = $request->get('city');
        }
        if($request->get('police_station') != ''){
            $sql->where('police_station',$request->get('police_station'));
            $inputs['police_station'] = $request->get('police_station');
        }
        $hotels = $sql->get();

        $fileName = 'hotels.csv';

        $headers = array(
            'Content-Type' => 'application/vnd.ms-excel; charset=utf-8',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=hotels.csv',
            'Expires' => '0',
            'Pragma' => 'public',
        );
        $filename =  public_path("files/hotels.csv");
        $handle = fopen($filename, 'w');

        $columns = array("Hotel name","Manage Name","Manage Mobile Number","Email","Owner Name","Ownere Mobile Number","hotel Address","registration","city","police Station",
            "Floor","Rooms","Direct Employee","OurSource Employee","Website");
        fputcsv($handle, $columns);
            foreach($hotels as $row){
                $arr = [];
                $arr[] = $row->hotel_name;
                $arr[] = $row->manage_name;
                $arr[] = $row->manage_mobile;
                $arr[] = $row->email;
                $arr[] = $row->owner_name;
                $arr[] = $row->owner_mobile;
                $arr[] = $row->address;
                $arr[] = $row->registration_number;
                $arr[] = $row->city_name;
                $arr[] = $row->police_station;
                $arr[] = $row->floors;
                $arr[] = $row->rooms;
                $arr[] = $row->direct_employee_count;
                $arr[] = $row->outsource_employee_count;
                $arr[] = $row->website;
                fputcsv($handle, $arr);
            }
            fclose($handle);
        return Response::download($filename, "hotels.csv", $headers);

    }
}
