<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Pirep;
use App\Models\User;
use App\Models\Enums\PirepState;
use App\Models\Enums\UserState;
use Carbon\Carbon;

class TopPilots extends Widget
{
  protected $config = ['count' => 3, 'type' => 'flights', 'period' => null, 'hub' => null];

  public function run()
  {
    $period = $this->config['period'];
    $type = $this->config['type'];

    $user_where = [];
    if ($this->config['hub']) {
      $user_where['home_airport_id'] = $this->config['hub'];
    }

    $user_states = array(UserState::ACTIVE, UserState::ON_LEAVE);
    $users_array = User::where($user_where)->whereIn('state', $user_states)->pluck('id')->toArray();

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
      $select_Raw = 'count(user_id)';
      $rtype = trans_choice('common.flight', 2);
    } elseif ($type === 'distance') {
      $select_Raw = 'sum(distance)';
      $rtype = __('common.distance');
    } elseif ($type === 'time') {
      $select_Raw = 'sum(flight_time)';
      $rtype = __('pireps.flighttime');
    } elseif ($type === 'landingrate') {
      $select_Raw = 'avg(landing_rate)';
      $rtype = __('DisposableTools::common.landingrate');
    } elseif ($type === 'score') {
      $select_Raw = 'avg(score)';
      $rtype = __('DisposableTools::common.score');
    }

    $tpilots = Pirep::with('user.airline')->selectRaw('user_id, '.$select_Raw.' as totals')
      ->where('state', PirepState::ACCEPTED)
      ->whereIn('user_id', $users_array)
      ->whereBetween('created_at', [$s_date, $e_date])
      ->orderBy('totals', 'desc')->groupBy('user_id')
      ->take($this->config['count'])->get();

    return view('DisposableTools::top_pilots', [
      'config'  => $this->config,
      'rperiod' => $period,
      'rtype'   => $rtype,
      'tpilots' => $tpilots,
    ]);
  }
}
