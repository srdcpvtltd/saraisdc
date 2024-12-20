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
use App\Models\Booking;
use Hash;
use Session;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
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

            //only check In book 
            $bookings = Booking::where('user_id',Auth::id())->whereHas('rooms', function($q){
                $q->where('status','0');
            })->orderBy('created_at','DESC')->paginate(20);
            Session::forget('loginError');
            return view('dashboard.homepage', compact('user', 'modual', 'role', 'languages','bookings'));
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
    public function all_notification(){
        $InvalidUsers = new \App\Services\Dashboard\InvalidUsers();
        $data = $InvalidUsers->getUsers();
        return view('notification.all_notification', compact('data'));
    }
    public function showChangePasswordGet() {
        return view('auth.passwords.change-password');
    }

    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

       return redirect('dashboard')->with('status', 'Password updated!');
    }
}
