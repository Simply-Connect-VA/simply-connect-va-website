<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Aircraft;
use App\Models\Enums\AircraftState;
use App\Models\Enums\AircraftStatus;

class AirportAircrafts extends Widget
{
  protected $config = ['location' => 'ZZZZ'];

  public function run()
  {
    $where = array('airport_id' => $this->config['location'], 'state' => AircraftState::PARKED, 'status' => AircraftStatus::ACTIVE);
    $eager_load = array('subfleet.airline');

    $aircraft = Aircraft::with($eager_load)->where($where)->orderBy('icao')->orderBy('registration')->get();

    return view('DisposableTools::airport_aircrafts', [
      'aircraft' => $aircraft,
    ]);
  }
}
