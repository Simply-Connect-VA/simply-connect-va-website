<?php

namespace Modules\DisposableHubs\Http\Controllers;

use App\Contracts\Controller;
use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Subfleet;
use App\Models\User;
use League\ISO3166\ISO3166;
use Nwidart\Modules\Facades\Module;

class HubsController extends Controller
{
  // Hubs
  public function hubs()
  {
    $hubs = Airport::where('hub', 1)->orderby('name')->get();

    if (!$hubs) {
      flash()->error('No Hubs Found !');
      return redirect(route('frontend.dashboard.index'));
    }

    return view('DisposableHubs::index', [
      'hubs'    => $hubs,
      'country' => new ISO3166()
    ]);
  }

  // Hub
  public function show($id)
  {
    $hub = Airport::with('files')->where(['id' => $id, 'hub' => 1])->first();

    if (!$hub) {
      flash()->error('Airport Is Not Hub !');
      return redirect(route('DisposableHubs.hindex'));
    }

    $DisposableTools = Module::find('DisposableTools');
    if ($DisposableTools) {
      $DisposableTools = $DisposableTools->isEnabled();
    }

    // Aircraft
    $hub_subfleets = Subfleet::where('hub_id', $hub->id)->pluck('id')->toArray();
    $haircrafts = Aircraft::with('subfleet.airline')->whereIn('subfleet_id', $hub_subfleets)->orderby('icao')->orderby('registration')->get();
    $vaircrafts = Aircraft::with('subfleet.airline')->whereNotIn('subfleet_id', $hub_subfleets)->where('airport_id', $hub->id)->orderby('icao')->orderby('registration')->get();

    // Pilots
    $hub_where = [];
    $off_where = [];

    $hub_where['home_airport_id'] = $hub->id;
    $off_where[] = ['home_airport_id', '!=', $hub->id];
    $off_where['curr_airport_id'] = $hub->id;
    if (setting('pilots.hide_inactive')) {
      $hub_where['state'] = 1;
      $off_where['state'] = 1;
    }

    $hpilots = User::with('airline')->where($hub_where)->orderby('id')->get();
    $vpilots = User::with('airline')->where($off_where)->orderby('id')->get();

    // Flights
    $d_where = array('dpt_airport_id' => $hub->id, 'active' => 1, 'visible' => 1);
    $a_where = array('arr_airport_id' => $hub->id, 'active' => 1, 'visible' => 1);

    $deps = Flight::with('arr_airport', 'airline')->where($d_where)->orderby('arr_airport_id')->get();
    $arrs = Flight::with('dpt_airport', 'airline')->where($a_where)->orderby('dpt_airport_id')->get();

    return view('DisposableHubs::show', [
      'disptools'  => $DisposableTools,
      'country'    => new ISO3166(),
      'hub'        => $hub,
      'haircrafts' => $haircrafts,
      'vaircrafts' => $vaircrafts,
      'hpilots'    => $hpilots,
      'vpilots'    => $vpilots,
      'arrs'       => $arrs,
      'deps'       => $deps,
    ]);
  }
}
