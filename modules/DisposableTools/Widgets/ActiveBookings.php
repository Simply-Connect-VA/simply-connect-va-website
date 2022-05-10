<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\SimBrief;

class ActiveBookings extends Widget
{
  // Set Widget Auto Refresh Time (Seconds)
  public $reloadTimeout = 65;

  public function run()
  {
    $eager_load = array('aircraft', 'flight.dpt_airport', 'flight.arr_airport', 'user');
    $bookings = SimBrief::with($eager_load)->whereNotNull('flight_id')->whereNotNull('aircraft_id')->whereNull('pirep_id')->orderby('created_at', 'desc')->get();

    return view('DisposableTools::active_bookings', [
      'bookings' => $bookings
    ]);
  }
}
