<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Airline;
use App\Models\Pirep;
use App\Models\Enums\PirepState;
use Carbon\Carbon;

class TopAirlines extends Widget
{
  protected $config = ['count' => 3, 'type' => 'flights', 'period' => null];

  public function run()
  {
    $period = $this->config['period'];
    $type = $this->config['type'];

    $airlines_array = Airline::where('active', 1)->pluck('id')->toArray();

    $now = Carbon::now();

    if ($period === 'currentm' || $period === 'currenty') { $b_date = $now; }
    elseif ($period === 'lastm') { $b_date = $now->subMonthNoOverflow(); }
    elseif ($period === 'prevm') { $b_date = $now->subMonthsNoOverflow(2); }
    elseif ($period === 'lasty') { $b_date = $now->subYearNoOverflow(); }
    elseif ($period === 'prevy') { $b_date = $now->subYearsNoOverflow(2); }

    if ($period === 'currenty' || $period === 'lasty' || $period === 'prevy') {
      $s_date = $b_date->startOfYear();
      $e_date = $b_date->copy()->endOfYear();
      $period = $b_date->format('Y');
    } elseif ($period === 'currentm' || $period === 'lastm' || $period === 'prevm') {
      $s_date = $b_date->startOfMonth();
      $e_date = $b_date->copy()->endOfMonth();
      $period = $b_date->format('F');
    } else {
      $s_date = '1978-07-15 00:00:01';
      $e_date = $now;
    }

    if ($type === 'flights') {
      $select_Raw = 'count(airline_id)';
      $rtype = trans_choice('common.flight', 2);
    } elseif ($type === 'distance') {
      $select_Raw = 'sum(distance)';
      $rtype = __('common.distance');
    } elseif ($type === 'time') {
      $select_Raw = 'sum(flight_time)';
      $rtype = __('pireps.flighttime');
    } elseif ($type === 'landingrate') {
      $select_Raw = 'avg(landing_rate)';
      $rtype = __('DisposableTools::common.avglanding');
    } elseif ($type === 'score') {
      $select_Raw = 'avg(score)';
      $rtype = __('DisposableTools::common.avgscore');
    }

    $tairlines = Pirep::with('airline')->selectRaw('airline_id, '.$select_Raw.' as totals')
      ->where('state', PirepState::ACCEPTED)
      ->whereIn('airline_id', $airlines_array)
      ->whereBetween('created_at', [$s_date, $e_date])
      ->orderBy('totals', 'desc')->groupBy('airline_id')
      ->take($this->config['count'])->get();

    return view('DisposableTools::top_airlines', [
      'config'    => $this->config,
      'rperiod'   => $period,
      'rtype'     => $rtype,
      'tairlines' => $tairlines,
    ]);
  }
}
