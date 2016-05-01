<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Mail;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $confirmation_code = str_random(30); 
        $data1 = [
            'confirmation_code' => $confirmation_code
        ];
        Mail::send('emails.index', $data1, function ($m) use ($data) {
            $m->to($data['email'], $data['name'])->subject('Your Reminder!');
        });
        return User::create([
            'user_name' => $data['name'],
            'email' => $data['email'],
            'confirmed' => 0,
            'confirmation_code' => $confirmation_code,
            'password' => bcrypt($data['password']),
            'gender_id' => $data['gender'],
            'role_id' => 1,
            
        ]);
    }

    protected function confirmEmail($confirmationCode){
        if( ! $confirmationCode)
        {
            return redirect('/')->with('message', 'Invalid COnfirmation code');
           // throw new InvalidConfirmationCodeException;
        }

        $user = User::whereconfirmation_code($confirmationCode)->first();

        if ( ! $user)
        {
            return redirect('/')->with('message', 'You have already confirmed the email');
            //throw new InvalidConfirmationCodeException;
        }

        $user->confirmed = 1;
        $user->confirmation_code = null;
        $user->save();


        return view('auth.login')->with('message', 'Please confirm your email address');
    }

    

}
