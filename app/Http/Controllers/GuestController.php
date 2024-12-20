<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingRoom;
use App\Models\Criminal;
use App\Models\CriminalBookingMatch;
use App\Models\HotelProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class GuestController extends Controller
{
    public function index()
    {
        $countries = \DB::table('countries')
            ->get();
        return view('guest.register', compact('countries'));
    }

    public function store(Request $request)
    {
        // check is hotel avialble or not
        $hotel = HotelProfile::where('user_id',Auth::id())->first();
        //dd($request->all());
        if(!$hotel) {
            return redirect('/add-hotel')->with('success', "Please create hotel first.");
        }
        $booking = new Booking();
        // guest image
        if ($request->guest_image) {
            $image_64 = $request->guest_image; //your base64 encoded data
            $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
            $replace = substr($image_64, 0, strpos($image_64, ',')+1);
            $image = str_replace($replace, '', $image_64);
            $image = str_replace(' ', '+', $image);
            $imageName = time().'.'.$extension;

            Storage::disk('local')->put( $imageName, base64_decode($image));

            $booking->guest_image = $imageName;
        }

        // if document id
        if ($request->file('document_id')) {
            $documentName = 'document_' . $request->file('document_id')->getClientOriginalName();
            $request->document_id->move(public_path('booking'), $documentName);
            $booking->document_id = $documentName;
        }

        // if document id
        if ($request->file('visitor_photo')) {
            $documentName = 'visitor_' . $request->file('visitor_photo')->getClientOriginalName();
            $request->visitor_photo->move(public_path('storage/bookings'), $documentName);
            $booking->guest_image = $documentName;
        }

        $booking->gues_name = $request->gues_name;
        $booking->mobile_number = $request->mobile_number;
        $booking->alter_mobile_number = $request->alter_mobile_number;
        $booking->age = $request->age;
        $booking->user_id = Auth::id();
        $booking->gender = $request->gender;
        $booking->email_id = $request->email_id;
        $booking->arrived_from = $request->arrived_from;
        $booking->nationality = $request->nationality;
        $booking->transport = $request->transport;
        $booking->house_number = $request->house_number;
        $booking->lane = $request->lane;
        $booking->land_mark = $request->land_mark;
        $booking->country_id = $request->country;
        $booking->hotel_id = $hotel->id;
        $booking->state_id = $request->state;
        $booking->city_id = $request->city;
        $booking->present_town = $request->present_town;
        $booking->present_pin = $request->present_pin;
        $booking->p_house_number = $request->p_house_number;
        $booking->p_lane = $request->p_lane;
        $booking->p_land_mark = $request->p_land_mark;
        $booking->p_country_id = $request->p_country;
        $booking->p_state_id = $request->p_state;
        $booking->p_city_id = $request->p_city;
        $booking->p_town = $request->p_town;
        $booking->p_pin = $request->p_pin;
        $booking->local_contact_name = $request->local_contact_name;
        $booking->local_contact_number = $request->local_contact_number;
        $booking->accompany_adult = $request->accompany_adult;
        $booking->accompany_children = $request->accompany_children;

        $booking->arrival_date = $request->arrival_date;
        $booking->arrival_time = $request->arrival_time;
        $booking->id_type = $request->id_type;
        $booking->id_number = $request->id_number;
        $booking->remarks = $request->remarks;
        $booking->accompany_person = $request->accompany_person;
        $booking->room_booked = $request->room_booked;
        $booking->whom_to_visit = $request->whom_to_visit;
        $booking->whom_to_visit_name = $request->whom_to_visit_name;
        $booking->whom_to_visit_mobile = $request->whom_to_visit_mobile;
        $booking->is_visited_before = $request->is_visited_before;

        $booking->other_country = $request->other_country;
        $booking->p_other_country = $request->p_other_country;
        $booking->other_state = $request->other_state;
        $booking->p_other_state = $request->p_other_state;
        $booking->other_city = $request->other_city;
        $booking->p_other_city = $request->p_other_city;

        $booking->save();

        if ($booking) {
            // save booking rooms
            if($request->bookingdata) {
                $booking->rooms()->createMany($request->bookingdata);
            }
            if($request->accompany) {
                $booking->accompanies()->createMany($request->accompany);
            }
        }
        //dd($booking);
        return redirect('/dashboard')->with('success', "Booking created successfully.");
    }

//    public function list() {
//        $bookings = Booking::where('user_id',Auth::id())->orderBy('created_at','DESC')->paginate(20);
//        return view('guest.list',['bookings' => $bookings]);
//    }

    public function show($bookingId) {
        $booking = Booking::where('user_id',Auth::id())->where('id',$bookingId)->with(['country','state','city','rooms','accompanies','nationalityName','p_country','p_city','p_state'])->first();

        return view('guest.detail')->with('booking' ,$booking);
    }

    public function mark_suspicious($bookingId) {
        $update = Booking::where('user_id',Auth::id())->where('id',$bookingId)->update(['suspicious' => 1]);
        return Redirect::back()->withErrors(['message'=>'Marked as suspicious']);
    }

    public function mark_unsuspicious($bookingId) {

        $update = Booking::where('user_id',Auth::id())
        ->where('id',$bookingId)->update(['suspicious' => 0]);

        //remove criminal match entry
        $crimimatch = CriminalBookingMatch::where('booking_id',$bookingId)->first();

        if(!empty($crimimatch))
            $crimimatch->delete();

        return Redirect::back()->withErrors(['message'=>'Marked as NOT suspicious']);
    }

    public function adminshow($bookingId) {
        $booking = Booking::where('id',$bookingId)->with(['country','state','city','rooms','accompanies','nationalityName','p_country','p_city','p_state'])->first();

        $criminal = $crimminalMatch = null;
        //get criminal mapping if any
        $crimminalMatch = CriminalBookingMatch::where('booking_id',$bookingId)->first();
        if($crimminalMatch){
            //get criminal details
            $criminal = Criminal::where('id',$crimminalMatch->criminal_id)->first();
        }
        return view('guest.detail')->with(compact('booking','criminal'));
    }

    public function checkOut($bookingId, $roomId) {
        $room = BookingRoom::where('id',$roomId)->where('booking_id',$bookingId)->first();
        if ($room->status == 0) {
            // booking completed
            $room->status = 1;
            $room->checkout_date = date('Y-m-d',time());
            $room->checkout_time = date('H:i',time());
            $room->save();
            return redirect()->back()->with('success', "Booking status set completed");
        } else {
            $room->status = 0;
            $room->checkout_date = null;
            $room->checkout_time = null;
            $room->save();
            return redirect()->back()->with('success', "Booking status set in progress");
        }

    }

    public function guestFilter(Request $request) {
        $guestName = $request->guest_name;
        $guestMobile = $request->mobile_number;
        $email = $request->email;

        $bookings = Booking::where('user_id',Auth::id())->orderBy('created_at','DESC')
        ->when($request->guest_name != '', function($query) use ($guestName){
            $query->where('gues_name','LIKE', '%' . $guestName . '%');
        })
        ->when($request->mobile_number != '', function($query) use ($guestMobile){
            $query->where('mobile_number','LIKE', '%' . $guestMobile . '%');
        })
        ->when($request->mobile_number != '', function($query) use ($guestMobile){
            $query->where('alter_mobile_number','LIKE', '%' . $guestMobile . '%');
        })
        ->when($request->mobile_number != '', function($query) use ($email){
            $query->where('email_id','LIKE', '%' . $email . '%');
        })
        ->paginate(20);
        return view('guest.list',['bookings' => $bookings]);
    }

    public function bookingDelete($bookingId) {
        $booking = Booking::where('user_id',Auth::id())->where('id',$bookingId)->first();
        $booking->rooms()->delete();
        $booking->accompanies()->delete();
        $booking->delete();
        return redirect()->back()->with('success', "Booking deleted successfully");

    }
     public function checkoutList() {
        $bookings = Booking::where('user_id',Auth::id())
                ->whereIn('id',function($q){
                    $q->select('booking_id')->from('booking_rooms')->where('status',0);
                })
                ->orderBy('created_at','DESC')->paginate(20);
        return view('guest.list',['bookings' => $bookings]);
    }
    public function quickinvoice($id){
        $booking = Booking::with('rooms')->where('user_id',Auth::id())->where('id',$id)->first();
        return view('guest.quickInvoice',compact('booking'));
    }
    public function pdfquickinvoice($id){
        $booking = Booking::with('rooms')->where('user_id',Auth::id())->where('id',$id)->first();
        return view('guest.pdfquickInvoice',compact('booking'));
    }

    public function getGuestDetail(Request $request) {

        $booking = Booking::where('mobile_number',$request->mobile)->first();

        return response()->json($booking);
    }
}
