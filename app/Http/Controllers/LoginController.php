<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Session;
use Redirect;

class LoginController extends Controller
{
    public function index() {
        if(Auth::check()) {
            return Redirect('/panel');
        } else {
            return view("Login");
        }
    }

    public function access(Request $request) {
        if(Auth::attempt([  'user'      => $request['user'], 
                            'password'  => $request['password']])) {
            
           return Redirect('/panel');
        } else {
            Session::flash("login_error_title", Errors::LOGIN_01_TITLE);
            Session::flash("login_error_message", Errors::LOGIN_01_MESSAGE);
            return Redirect('/');
        }
    }

    public function logout() {
        if (Auth::check()) {
           Auth::logout();
           Session::flush();
        }
        return Redirect('/');
   }
}
