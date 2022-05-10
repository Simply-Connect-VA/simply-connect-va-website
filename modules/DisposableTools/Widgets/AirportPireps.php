<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Pirep;
use App\Models\Enums\PirepState;
use App\Models\Enums\PirepStatus;

class AirportPireps extends Widget
{
  protected $config = ['location' => 'ZZZZ', 'count' => null];

  public function run()
  {
    if (!is_numeric($this->config['count'])) {
      $this->config['count'] = 250;
    }

    $eager_load = array('aircraft', 'arr_airport', 'dpt_airport', 'user');
    $where = array('state' => PirepState::ACCEPTED, 'status' => PirepStatus::ARRIVED);

    $pireps = Pirep::with($eager_load)
      ->where('dpt_airport_id', $this->config['location'])->where($where)
      ->orWhere('arr_airport_id', $this->config['location'])->where($where)
      ->orderBy('submitted_at', 'desc')
      ->take($this->config['count'])
      ->get();

    return view('DisposableTools::airport_pireps', [
      'pireps' => $pireps,
      'config' => $this->config,
    ]);
  }
}
