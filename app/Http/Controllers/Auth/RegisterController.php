<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use App\Jobs\SendVerificationEmail;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Hotel;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'], //'unique:users'
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        $isExsist = User::Where('email',$data['email'])->first();
        if($isExsist)
        {
            header('location:login?iserror=1');
            die;
        } else {
            $user= User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'created_by' => 1,
                'type'=>'user',
                'email_token' => base64_encode($data['email']),

            ]);
            $role=Role::findByName('user');
            if($role){
                $user->assignRole($role->id);
            }
            return $user;
        }
    }
    
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));
        $email_token = Crypt::encryptString($user->email . "_".$user->id);

        $user->email_token = $email_token;
        $user->save();
        dispatch(new SendVerificationEmail($user));

        return view('verification');
    }
    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();
        $user->verified = 1;
        $user->email_verified_at = date('Y-m-d H:i:s');;

        if($user->save()){
            return view('emailconfirm', ['user' => $user]);
        }
    }
}
