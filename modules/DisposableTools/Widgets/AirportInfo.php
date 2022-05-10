<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Repositories\AirportRepository;

// Widget Designed By MacoFallico, slightly enhanced By FatihKoz
class AirportInfo extends Widget
{
  protected $config = ['type' => 'all'];

  public function run()
  {
    $airportRepo = app(AirportRepository::class);

    $where = [];
    if ($this->config['type'] === 'hubs') {
      $where['hub'] = 1;
      if (Dispo_Modules('DisposableHubs')) { $aptroute = 'DisposableHubs.hshow'; }
    }
    elseif ($this->config['type'] === 'nohubs') {
      $where['hub'] = 0;
    }

    $airports = $airportRepo->select('id', 'iata', 'name', 'location', 'country', 'hub')->where($where)->orderBy('id')->get();

    return view('DisposableTools::airport_info', [
      'airports' => $airports,
      'config'   => $this->config,
      'aptroute' => isset($aptroute) ? $aptroute : 'frontend.airports.show',
    ]);
  }
}
