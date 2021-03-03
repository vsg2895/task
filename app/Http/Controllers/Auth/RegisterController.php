<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MailController;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;



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
    protected $redirectTo = RouteServiceProvider::HOME;

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
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'min:5', 'max:15'],
            'lastname' => ['required', 'string', 'min:9', 'max:19'],
            'phone' => ['required', 'regex:/(0)[0-9]/', 'max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],

        ]);
//        dd($data);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */


    public function register(Request $request)
    {

        $validation = $request->validate([
            'name' => 'required | min:5 | max:15 | string',
            'lastname' => 'required | min:9 | max:19 | string',
            'phone' => 'required | max:9 | regex:/(0)[0-9]/',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
            'g-recaptcha-response' => 'required',
            'role'=>'required',


        ]);
//dd($validation->errors());

        if ($request->role == 3){

            $all_users_count = User::withTrashed()->where('role_id',3)->count();

            if ($all_users_count == 100){

                return redirect()->back()->with(session()->flash('alert-danger','You can not register because the number of users has expired'));
            }
        }
        elseif ($request->role == 2){

            $all_users_count = User::withTrashed()->where('role_id',2)->count();

            if ($all_users_count == 3){

                return redirect()->back()->with(session()->flash('alert-danger','You can not register because the number of moderators has expired'));
            }
        }
        else {

            $all_users_count = User::withTrashed()->where('role_id',1)->count();

            if ($all_users_count == 1){

                return redirect()->back()->with(session()->flash('alert-danger','You can not register because the number of admins has expired'));
            }
        }

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->verifycation_code =sha1(time());
        $user->save();

        if ($user != null){


            //Send message
            //Show message
            MailController::sendSignupEmail($user->name,$user->lastname,$user->email,$user->verifycation_code);
            return redirect()->back()->with(session()->flash('alert-success','Your account has been created.Please check email verification link'));


        }
        return redirect()->back()->with(session()->flash('alert-danger','Something went wrong'));

        //show error message



    }
    public function verify(Request $request){

        $verifycation_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where('verifycation_code',$verifycation_code)->first();
        if ($user != null){

            $user->is_verified = 1;
            $user->save();
            return redirect()->route('login')->with(session()->flash('alert-success','Your account is verified, Please login'));

        }

        return redirect()->route('login')->with(session()->flash('alert-danger','Invalide verification code'));




    }


}
