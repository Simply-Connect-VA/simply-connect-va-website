<?php

namespace Modules\DisposableAirlines\Http\Controllers;

use App\Contracts\Controller;
use App\Models\Pirep;
use App\Models\Enums\PirepState;

class PirepsController extends Controller
{
  // All Pireps (except inProgress flights)
  public function allpireps()
  {
    $eager_load = array('airline', 'aircraft', 'arr_airport', 'dpt_airport', 'user');
    $pireps = Pirep::with($eager_load)->where('state', '!=', PirepState::IN_PROGRESS)->orderby('submitted_at', 'desc')->paginate(25);

    return view('DisposableAirlines::pireps',[
      'pireps' => $pireps,
    ]);
  }
}
