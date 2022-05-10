<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;

class ContactController extends Controller
{
    /**
     * Show the contact page
     */
    public function index()
    {
        return view('contact');
    }
}
