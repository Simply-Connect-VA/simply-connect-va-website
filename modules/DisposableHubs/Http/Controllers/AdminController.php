<?php

namespace Modules\DisposableHubs\Http\Controllers;

use App\Contracts\Controller;

class AdminController extends Controller
{
  // Admin Page
  public function admin()
  {
    return view('DisposableHubs::admin');
  }

}
