<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $root = 'dshbrd';
    private $default_route = 'dashboard';

    public function index()
    {
        return view('pages.dashboard');
    }
}
