<?php

namespace Modules\DisposableRanks\Http\Controllers;

use App\Contracts\Controller;
use App\Models\Award;

class DispoAwardsController extends Controller
{
  // Awards
  public function awards()
  {
    $awards = Award::orderby('id')->get()->sortby('name', SORT_NATURAL);

    return view('DisposableRanks::awards', [
      'awards' => $awards
    ]) ;
  }
}
