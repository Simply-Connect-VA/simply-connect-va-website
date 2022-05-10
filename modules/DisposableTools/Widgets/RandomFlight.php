<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Flight;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\DisposableTools\Models\Disposable_RandomFlight;
use Carbon\Carbon;

class RandomFlight extends Widget
{
  protected $config = ['count' => null, 'daily' => false, 'hub' => false];

  public function run()
  {
    $count = (is_numeric($this->config['count']) && $this->config['count'] > 0) ? $this->config['count'] : 1;
    $today = Carbon::today();
    $user = Auth::user();

    // Failsafe
    if (!$user) { return null; }

    // Clean Out Old Entries
    Disposable_RandomFlight::where('assign_date', '!=', $today)->delete();

    // Get User Location
    if ($this->config['hub'] === true) {
      $orig = $user->home_airport_id;
    } else {
      $orig = filled($user->curr_airport_id) ? $user->curr_airport_id : $user->home_airport_id;
    }

    $whereRF = [];
    $whereRF['user_id'] = $user->id;
    $whereRF['assign_date'] = $today;

    // Pick Flights & Save
    $rfs = Disposable_RandomFlight::where($whereRF)->get();

    if ($this->config['daily'] === true && $rfs->isEmpty()) {
      $this->PickRandomFlights($user, $orig, $count);
    } elseif ($this->config['daily'] === false && $rfs->where('airport_id', $orig)->count() === 0) {
      $this->PickRandomFlights($user, $orig, $count);
    }

    // Get Flights and Return
    $rfs = Disposable_RandomFlight::with('flight.airline', 'flight.dpt_airport', 'flight.arr_airport', 'pirep', 'user')->where($whereRF)->get();

    return view('DisposableTools::random_flight',[
      'random_flights' => $rfs,
      'today'          => $today,
    ]);
  }

  public function PickRandomFlights($user, $orig, $count)
  {
    // Get Flights
    $where = [];
    $where['active'] = 1;
    $where['visible'] = 1;
    $where['dpt_airport_id'] = $orig;

    // Apply phpVMS Settings
    if (setting('pilots.restrict_to_company', false)) {
      $where['airline_id'] = $user->airline_id;
    }

    if (setting('pireps.restrict_aircraft_to_rank', false)) {
      $allowed_subfleets = $user->rank->subfleets()->pluck('id')->toArray();
      $allowed_flights = DB::table('flight_subfleet')->whereIn('subfleet_id', $allowed_subfleets)->pluck('flight_id')->toArray();
      $flights = Flight::where($where)->whereIn('id', $allowed_flights)->get();
    } else {
      $flights = Flight::where($where)->get();
    }

    // Eliminate Already Flown
    $wherePirep = [];
    $wherePirep['user_id'] = $user->id;
    $wherePirep['dpt_airport_id'] = $orig;
    $wherePirep['state'] = 2;

    $flown = DB::table('pireps')->where($wherePirep)->groupby('flight_id')->pluck('flight_id')->toArray();

    if (count($flights) > count($flown)) {
      $flights = $flights->whereNotIn('id', $flown);
    }

    // Get Random Flights with Failsafe
    $flights = $flights->pluck('id');

    if ($flights->count() < $count) { $count = $flights->count(); }
    $flights = $flights->random($count);

    $today = Carbon::today();

    // Save each flight
    foreach ($flights as $flight) {
      Disposable_RandomFlight::create([
        'user_id'     => $user->id,
        'airport_id'  => $orig,
        'flight_id'   => $flight,
        'assign_date' => $today,
      ]);
    }
  }
}
