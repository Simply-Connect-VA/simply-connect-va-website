<?php

namespace Modules\DisposableTech\Widgets;

use App\Contracts\Widget;
use Modules\DisposableTech\Models\Disposable_Tech;

class FuelCalculator extends Widget
{

  protected $config = ['icao' => null];

  public function run() {

    $where = [];
    if ($this->config['icao']) {
      $where['icao'] = $this->config['icao'];
    }

    $fuel_figures = Disposable_Tech::select('icao', 'avg_fuel')->where($where)->whereNotNull('avg_fuel')->orderBy('icao')->get();

    return view('DisposableTech::widget_fuelcalculator', [
      'fuel_figures' => $fuel_figures,
      'metric' => (setting('units.fuel') === 'kg') ? true : false,
    ]);
  }
}
