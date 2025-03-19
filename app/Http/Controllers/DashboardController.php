<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('dashboard.index', ['user' => Auth::user()]);
    }

    public function adminDashboard(): View
    {
        return view('dashboard.index'); 
    }

    public function usersDashboard(): View
    {
        return view('dashboard.users'); 
    }
}

