<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Criminal;
use App\Models\CriminalBookingMatch;
use Illuminate\Http\Request;

class FaceRecognitionController extends Controller
{
    public function criminals(Request $request){

        $items = Criminal::select([
            'id',
            'name',
            'photo',
         ])
         ->orderBy('created_at','DESC')
         ->get();

        $items->map(function ($item, $key) {
            return $item->photo_url = url('storage/criminals/'.$item->photo);
        });
        $items->all();

        $data = $items->toArray();

        return response($data);
    }

    public function guests(Request $request){

        $booking = Booking::select([
            'id as id',
            'gues_name as name',
            'guest_image as photo'
         ])
         ->whereNull('suspicious')
         ->where('suspicious_check',0)
         ->orderBy('created_at','DESC')
         ->first();

        $booking->photo_url = url('storage/bookings/'.$booking->photo);

        return response([$booking]);
    }

    public function saveBgCheckResults(Request $request){

        $data = $request->all();

        $suspicious = $data['suspicious'] == 'yes' ? 1 : 0;

        if(empty($data['booking_id']))
            return response('invalid booking id');

        try{
            if($suspicious){
                if(
                    !empty($data['criminal_id'])
                    && !empty($data['booking_id'])
                    && !empty($data['accuracy'])
                ){
                    CriminalBookingMatch::updateOrCreate(
                        [
                            'criminal_id' => $data['criminal_id'],
                            'booking_id' => $data['booking_id'],
                        ],
                        [
                            'accuracy' => $data['accuracy']
                        ]
                    );
                }
            }else{
                //either there was no match
                //guest booking without any valid image
            }

            //update booking info as  in both cases
            Booking::where('id',$data['booking_id'])
            ->update([
                'suspicious' => $suspicious,
                'suspicious_check' => 1,// 1 - processed, 0 - pending
            ]);

        }catch(\Exception $e){
            return response('error '.substr($e->getMessage(), 0, 100));
        }
        return response( (($suspicious==0) ? 'NOT' : '') . ' Marked suspicious');

    }

}
