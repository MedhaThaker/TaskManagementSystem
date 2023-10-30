<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index()
    {
        return !empty(Session::has('user*%')) ? redirect('tasks') :  view('login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        $user_data = array(
            'name' => $request->get('name'),
            'password' => $request->get('password')
        );

        if (Auth::guard('customauth')->attempt($user_data)) {
            $user_id = Auth::guard('customauth')->user()->id;
            Session::put('user*%', $user_id);
            return redirect('tasks')->with('success', 'Login successfull!');
        } else {
            return redirect()->with('error', 'Invalid Login Details!');
        }
    }
    //destroy login session data using logout function
    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        return redirect('/')->with('success', 'Logged out Successfully!');
    }

}
