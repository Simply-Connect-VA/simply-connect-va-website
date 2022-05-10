<?php

namespace Modules\DisposableHubs\Http\Controllers;

use App\Contracts\Controller;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;

class StatsController extends Controller
{
  // Stats
  public function stats()
  {
    $DisposableTools = Module::find('DisposableTools');
    if ($DisposableTools) {
      $DisposableTools = $DisposableTools->isEnabled();
    }

    $TotalAirlines = DB::table('airlines')->count();
    $TotalinactiveAirlines = DB::table('airlines')->where('active', '!=', '1')->count();

    $TotalSubFleets = DB::table('subfleets')->count();
    $TotalAircrafts = DB::table('aircraft')->where('status', 'A')->count();
    $TotalinactiveAircrafts = DB::table('aircraft')->where('status', '!=', 'A')->count();

    $TotalPilots = DB::table('users')->where('state', '1')->count();
    $TotalinactivePilots = DB::table('users')->where('state', '!=', '1')->count();

    $TotalAirports = DB::table('airports')->count();
    $TotalHubs = DB::table('airports')->where('hub', '1')->count();

    $TotalFlights = DB::table('flights')->count();

    $TotalPireps = DB::table('pireps')->where('state', '2')->count();
    $TotalRejectedPireps = DB::table('pireps')->where('state', '6')->count();
    $TotalFlightTime = DB::table('pireps')->where('state', '2')->sum('flight_time');
    $TotalFuelUsed = DB::table('pireps')->where('state', '2')->sum('fuel_used');
    $TotalDistanceFlown = DB::table('pireps')->where('state', '2')->sum('distance');

    $AvgFuelUsed = DB::table('pireps')->where('state', '2')->avg('fuel_used');
    $AvgDistance = DB::table('pireps')->where('state', '2')->avg('distance');
    $AvgFlightTime = DB::table('pireps')->where('state', '2')->avg('flight_time');

    $AvgLandingRate = DB::table('pireps')->where(['state' => '2', 'source' => '1'])->avg('landing_rate');
    $AvgScore = DB::table('pireps')->where(['state' => '2', 'source' => '1'])->avg('score');

    if ($TotalFuelUsed > 0 && $TotalFlightTime > 0) {
      $AvgFuelHour = ($TotalFuelUsed / $TotalFlightTime) * 60;
    } else {
      $AvgFuelHour = 0;
    }

    if (setting('units.fuel') === 'kg') {
      $TotalFuelUsed = $TotalFuelUsed / 2.20462262185;
      $AvgFuelUsed = $AvgFuelUsed / 2.20462262185;
      $AvgFuelHour = $AvgFuelHour / 2.20462262185;
    }

    if (setting('units.distance') === 'km') {
      $TotalDistanceFlown = $TotalDistanceFlown * 1.852;
      $AvgDistance = $AvgDistance * 1.852;
    } elseif (setting('units.distance') === 'mi') {
      $TotalDistanceFlown = $TotalDistanceFlown * 1.15078;
      $AvgDistance = $AvgDistance * 1.15078;
    }

    return view('DisposableHubs::stats',[
      'disptools'              => $DisposableTools,
      'TotalAirlines'          => $TotalAirlines,
      'TotalinactiveAirlines'  => $TotalinactiveAirlines,
      'TotalSubFleets'         => $TotalSubFleets,
      'TotalAircrafts'         => $TotalAircrafts,
      'TotalinactiveAircrafts' => $TotalinactiveAircrafts,
      'TotalPilots'            => $TotalPilots,
      'TotalinactivePilots'    => $TotalinactivePilots,
      'TotalAirports'          => $TotalAirports,
      'TotalHubs'              => $TotalHubs,
      'TotalFlights'           => $TotalFlights,
      'TotalPireps'            => $TotalPireps,
      'TotalRejectedPireps'    => $TotalRejectedPireps,
      'TotalFlightTime'        => $TotalFlightTime,
      'TotalFuelUsed'          => $TotalFuelUsed,
      'TotalDistanceFlown'     => $TotalDistanceFlown,
      'AvgFlightTime'          => $AvgFlightTime,
      'AvgFuelUsed'            => $AvgFuelUsed,
      'AvgFuelHour'            => $AvgFuelHour,
      'AvgDistance'            => $AvgDistance,
      'AvgLandingRate'         => $AvgLandingRate,
      'AvgScore'               => $AvgScore,
    ]);
  }
}
