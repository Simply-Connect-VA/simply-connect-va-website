<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;

class DonationsController extends Controller
{
    /**
     * Show the donation page
     */
    public function index()
    {
        return view('donations');
    }
}
