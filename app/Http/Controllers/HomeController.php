<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Str;

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
        
        // $user = Auth::user();
        // $id= Auth::user()->id;
        // dd($id);
        // $userCount = User::all()->count();
        return view('home');
    }

    public function storeUserInfo(Request $request , User $user ) {
       
        $this->validate($request,[
            'dob'=>"required|date|before:".Carbon::now()->subYears(18),
            'streetAddress'=>"required|string|max:100",
            'city'=>"required|string|max:50",
            'state'=>"required|string|max:50",
        ]);

       
        $data =[
            
            'dob' => date("Y-m-d", strtotime($request->dob)),
            'lastName' =>  $request->streetAddress,
            'city' =>$request->city,
            'state' => $request->state,
           
           
        ];
        
            
        $user = User::find ($request->id);
      
        $user->update($data);
        $user->sendProfileRegisterNotification();
        
       
        
        return response()->json(['success' => ' submitted successfully']);
    }
}
