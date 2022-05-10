<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Aircraft;
use App\Models\Airport;

class AircraftLists extends Widget
{
  protected $config = ['type' => 'location'];

  public function run()
  {

    if ($this->config['type'] === 'icao') {
      $aircraft = Aircraft::selectRaw('count(id) as result, icao')->groupBy('icao')->orderBy('icao', 'asc')->get();
    } else {
      $aircraft = Aircraft::with('airport')->selectRaw('count(id) as result, airport_id')->whereNotNull('airport_id')->groupBy('airport_id')->orderBy('result', 'desc')->get();
    }

    if ($this->config['type'] === 'nohubs') {
      $hubs = Airport::where('hub', 1)->pluck('id')->toArray();
      $aircraft = $aircraft->whereNotIn('airport_id', $hubs);
      $this->config['type'] = 'Non Hub Location';
    }

    return view('DisposableTools::aircraft_lists', [
      'aircraft' => $aircraft,
      'config'   => $this->config
    ]);
  }
}
