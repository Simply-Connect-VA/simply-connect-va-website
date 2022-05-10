<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Pirep;
use App\Models\Enums\PirepState;

class FlightBoard extends Widget
{
  public $reloadTimeout = 60;

  public function run()
  {
    $eager_load = array('aircraft', 'airline', 'arr_airport', 'dpt_airport', 'position', 'user');
    $flights = Pirep::with($eager_load)->where('state', PirepState::IN_PROGRESS)->orderby('updated_at', 'desc')->get();

    return view('DisposableTools::flight_board',[
      'flights' => $flights
    ]);
  }
}
