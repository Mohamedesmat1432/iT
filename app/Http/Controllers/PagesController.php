<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        return view('home');
    }
    
    public function users()
    {
        return view('pages.users');
    }

    public function departments()
    {
        return view('pages.departments');
    }

    public function companies()
    {
        return view('pages.companies');
    }

    public function licenses()
    {
        return view('pages.licenses');
    }

    public function patchs()
    {
        return view('pages.patchs');
    }

    public function switchs()
    {
        return view('pages.switchs');
    }

    public function ips()
    {
        return view('pages.ips');
    }

    public function edokis()
    {
        return view('pages.edokis');
    }

    public function emadEdeens()
    {
        return view('pages.emad-edeens');
    }
    
    public function userDashboard()
    {
        return view('pages.user-dashboard');
    }

    public function adminDashboard()
    {
        return view('pages.admin-dashboard');
    }

    public function supportDashboard()
    {
        return view('pages.support-dashboard');
    }
}
