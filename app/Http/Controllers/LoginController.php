<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;




class LoginController extends Controller
{
    public function create(){
        return view('login');
    }
    public function store(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=> 'required'
        ]);
        $credentials =  [
            'email' => $request->email,
            'password' => $request->password,
           // 'status' => 'active'
        ];
        $result = Auth::attempt($credentials
        ,$request->boolean('remember'));//check and login
        if($result){

            // authenticated
            
            return redirect()->intended('/');
    }
    return back()->withInput()->withErrors([
        'email' => 'Invalid credentails'
    ]);

    
}
}
