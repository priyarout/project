<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;

class UserController extends Controller
{

    public function index(Request $request)
    {
        $sentSuccess = Session::get('sentSuccess');
        
        return view('welcome', compact( 'sentSuccess'));
    }


    public function storeUser(Request $request, User $user)
    {
        session()->flash('system-action', [
            'action' => 'Create a Profile.',
            'description' => 'Created a profile. '
        ]);
        $this->validate($request,[
            'firstName'=>"required|string|max:50",
            'lastName'=>"required|string|max:50",
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required|min:6'
        ]);

        $firstName = $request->firstName;
        $lastName = $request->lastName; 
       
        $email =  $request->email;
        $password = $request->password;
        $verificationToken = strtoupper(str_random(10));
        $create =[
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'password' => bcrypt($password),
            'verificationToken' => $verificationToken,
           
        ];
        
       

        $user = User::create($create);
      
    
        
        $user->sendEmailVerificationNotification();

    
        return back()->with('sentSuccess', true);
    }



    public function confirmEmail(Request $request, $token)
    {
       

            $validator = Validator::make(['token'=> $token], [
                'token' => 'string|size:10'
            ]);
       
            $user = User::where('verificationToken', $token)->first();

            $validator->after(function ($validator) use ($token, $user) {
                if (!$user) {
                    $validator->errors()->add('token','responses.invalid-code');
                }
            });

            try {
                if ($validator->fails()) {
                    //throw exception so that system log will mark the request as unsuccessful
                    throw new \Illuminate\Validation\ValidationException($validator);
                } elseif (!$this->validateTokenExpiry($user)) {
                    $user->verificationToken = strtoupper(str_random(10));
                    $user->save();
                    //send email confirmation link
                    $user->sendEmailVerificationNotification();
                    //send response
                    return redirect('/login')->with('status', 'responses.verification-link-expired');
                }
                
            } catch (\Exception $e) {
                return redirect('/login')->withException($e);
            }
        }

        public function login()
        {
            return view('login');
        }
    }

