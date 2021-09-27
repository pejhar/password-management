<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Auth\Guard;

class LoginController extends Controller
{

    
    public function show()
    {
        return view('layouts.login');
    }


    public function handle(Guard $auth_guard)
    {
        if ($auth_guard->validate()) {

            $user = $auth_guard->user();
            $userName = $user->getAuthIdentifier();
            return redirect(RouteServiceProvider::HOME);
            
        } else {

            toastr()->error('Not authorized to access this page!');
            return back();

        }
    }
    
    
}