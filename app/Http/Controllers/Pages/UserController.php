<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function dashboard()
    {
        return view('pages.user.dashboard');
    }
}
