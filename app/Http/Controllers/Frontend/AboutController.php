<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;

class AboutController extends Controller
{
    /**
     * Show the about page
     */
    public function index()
    {
        return view('about');
    }
}
