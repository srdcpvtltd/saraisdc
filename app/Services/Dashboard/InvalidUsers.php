<?php

namespace App\Services\Dashboard;

use App\Models\Booking;
use Illuminate\Support\Facades\Auth;

class InvalidUsers {
    
    private $data = [];
    private $list_of_ids = [];
    
    public function __construct(){
        $this->data = self::getInvalidUers();
    }
    public function handleResponce(){
        $html = view('dashboard.invalid_cube')->with('data',$this->data)->render();
        return $html;
    }
    private function getInvalidUers(){
        $notifications = \App\Models\NotificationSetting::get();
        $list = [];
        foreach($notifications as $row){
             $sql= Booking::with(['city','state']);
                    if($row->name != ''){
                        $sql->where('gues_name','like','%'.$row->name.'%');
                    }
                    if($row->age_from != '' && $row->age_from != null && $row->age_to != '' && $row->age_to != null){
                        $sql->whereBetween('age',[$row->age_from,$row->age_to]);
                    }else if($row->age_from != ''){
                        $sql->where('age','>',$row->age_from);
                    }else if($row->age_to != ''){
                        $sql->where('age','<',$row->age_to);
                    }
                    if($row->country != '' && $row->country != null){
                        $sql->where('country_id', $row->country);
                    }
                    if($row->state != '' && $row->state != null){
                        $sql->where('state_id', $row->state);
                    }
                    if($row->city != '' && $row->city != null){
                        $sql->where('city_id' ,$row->city);
                    }
                    $sql->whereDate('created_at','>=',$row->created_at);
            $bookings = $sql->get();
            if($bookings && count($bookings)> 0){
                $ids = $bookings->pluck(['id'])->toArray();
                foreach($ids as $booking_id){
                    $list[] = $booking_id;
                }
            }
        }
        $this->list_of_ids = $list;
        return Booking::with(['hotelProfile','city','state'])->whereIn('id',$list)->limit(2)->orderBy('bookings.id','DESC')->get();
    }
    public function getUsers(){
        return Booking::with(['hotelProfile','city','state'])->whereIn('id',$this->list_of_ids)->orderBy('bookings.id','DESC')->paginate(300);
    }
    
}
