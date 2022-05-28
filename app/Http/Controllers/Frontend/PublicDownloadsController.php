<?php

namespace App\Http\Controllers\Frontend;

use App\Contracts\Controller;

class PublicDownloadsController extends Controller
{
    /**
     * Show the public download page
     */
    public function index()
    {
        return view('public-downloads');
    }
}