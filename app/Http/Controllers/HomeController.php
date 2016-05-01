<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }
    public function front()
    {
        return view('layouts.front');
    }
    public function about()
    {
        return view('pages.about');
    }
    public function contact()
    {
        return view('pages.contact');
    }
    public function admin()
    {
        return view('layouts.admin')
            ->with('page','Dashboard')
            ->with('privileges',$this->getPrivileges());
    }

    protected function validateContace(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|min:6',
            'message' => 'required|min:6',
        ]);
    }

    public function postContact(Request $request)
    {
        
        $validator = $this->validateContace($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        $data = $request->all();
        $confirmation_code = $data['message']; 
        $data1 = [
            'problem' => $confirmation_code,
            'email' => $data['email'],
            'name' => $data['name']
        ];
        Mail::queue('emails.contact', $data1, function ($m) use ($data) {
            $m->from($data['email'], $data['name'])->subject($data['subject']);
            $m->to('snkaushi@gmail.com')->subject($data['subject']);
        });

    
        return redirect('contact')
                ->with('message', 'Your message have been send.. Thank you!!');

    }
}
