<?php

namespace App\Services\Dashboard;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class GetUserBlocks {
    
    private $data = [];
    
    public function __construct(){
        $this->data['todayGuest'] = self::getGuestsCount(0);
        $this->data['yesterdayGuest'] = self::getGuestsCount(1);
        $this->data['daybeforeYesterdayGuest'] = self::getGuestsCount(2);
        $this->data['totalCheckIn'] = self::getTotalCheckIn();
        $this->data['totalCheckOut'] = self::getTotalCheckOut();
    }
    public function handleResponce(){
        return $this->data;
    }
    private function getGuestsCount($days){
        $bookings = Booking::where('user_id',Auth::id())->whereDate('arrival_date', date('Y-m-d',time()-(86400*$days)))->get();
        if($bookings && count($bookings) > 0){
            $total_bookings = count($bookings);
            return $bookings->sum('accompany_person') + $total_bookings;
        }
        return 0;

    }
    private function getTotalCheckIn(){
        $bookings = Booking::where('user_id',Auth::id())->whereDate('arrival_date', date('Y-m-d',time()))->get();
        return count($bookings);
    }
    private function getTotalCheckOut(){
        $bookings = Booking::where('user_id',Auth::id())->join('booking_rooms','bookings.id','=','booking_rooms.booking_id')
                ->where('booking_rooms.status',1)
                ->whereDate('booking_rooms.checkout_date', date('Y-m-d',time()))->get();
        return count($bookings);
    }
    
}
