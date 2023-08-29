<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function users()
    {
        return view('pages.admin.users');
    }

    public function departments()
    {
        return view('pages.admin.departments');
    }

    public function companies()
    {
        return view('pages.admin.companies');
    }

    public function licenses()
    {
        return view('pages.admin.licenses');
    }

    public function dashboard()
    {
        return view('pages.admin.dashboard');
    }
}
