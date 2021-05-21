<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    public function index()
    {
        return view('test');
    }

    public function logout()
    {
        Auth::logout();
        return Redirect()->route('login')->with('success', 'You have been logged out');
    }
}
