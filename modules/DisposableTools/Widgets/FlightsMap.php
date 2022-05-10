<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Aircraft;
use App\Models\Airport;
use App\Models\Flight;
use App\Models\Pirep;
use App\Models\Subfleet;
use App\Models\User;
use App\Models\Enums\AircraftState;
use App\Models\Enums\AircraftStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class FlightsMap extends Widget
{
  protected $config = ['source' => 0, 'visible' => true, 'limit' => null, 'airline' => null];

  public function run()
  {
    $mapcenter = setting('acars.center_coords');

    // Get User Location with Failsafe
    $user = User::with('current_airport', 'home_airport')->find(Auth::id());
    if ($user && $user->current_airport) {
      $user_a = $user->current_airport->id;
      $user_loc = $user->current_airport->lat.','.$user->current_airport->lon;
    } elseif ($user && $user->home_airport) {
      $user_a = $user->home_airport->id;
      $user_loc = $user->home_airport->lat.','.$user->home_airport->lon;
    } else {
      $user_a = 'ZZZZ';
      $user_loc = $mapcenter;
    }

    // Define Map Type
    if ($this->config['source'] === 0) {
      $type = 'generic';
    } elseif (is_numeric($this->config['source']) && $this->config['source'] != 0) {
      $airline_id = $this->config['source'];
      $type = 'airline';
    } elseif ($this->config['source'] === 'user') {
      $type = 'user';
    } elseif ($this->config['source'] === 'fleet') {
      $type = 'fleet';
    } else {
      $airport_id = $this->config['source'];
      $type = 'airport';
    }

    // Build User's Flown CityPairs for Flight Maps Only
    if (isset($user) && $type != 'fleet') {
      $user_pireps = DB::table('pireps')->select('arr_airport_id', 'dpt_airport_id')->where(['user_id' => $user->id, 'state' => 2, 'status' => 'ONB'])->get();
      $user_citypairs = collect();
      foreach ($user_pireps as $up) {
        $user_citypairs->push($up->dpt_airport_id.$up->arr_airport_id);
      }
      $user_citypairs = $user_citypairs->unique();
    }

    $where = [];
    $where['active'] = 1;

    $orwhere = [];
    $orwhere['active'] = 1;

    // Filter Flights To User's Current Location
    if ($type === 'generic' && setting('pilots.only_flights_from_current')) {
      $where['dpt_airport_id'] = $user_a;
      $mapcenter = $user_loc;
    }

    // Filter Flights to User's Company
    if ($type === 'generic' && setting('pilots.restrict_to_company') || $type === 'airport' && setting('pilots.restrict_to_company')) {
      $where['airline_id'] = $user->airline_id;
      $orwhere['airline_id'] = $user->airline_id;
    }

    // Filter Visible Flights
    if ($this->config['visible'] && $type != 'user' && $type != 'fleet') {
      $where['visible'] = 1;
      $orwhere['visible'] = 1;
    }

    $eager_load = array('airline', 'arr_airport', 'dpt_airport');

    // Get User Pireps
    if ($type === 'user') {
      $mapflights = Pirep::with($eager_load)->where(['user_id' => $user->id, 'state' => 2, 'status' => 'ONB'])->orderby('submitted_at', 'desc')->get();
    }

    // Generic Map : May Be Used at Flight Search or Somewhere Else To Show All Flights !
    elseif ($type === 'generic') {
      $mapflights = Flight::with($eager_load)->where($where)->orderby('flight_number')->get();
    }

    // Airline Flights Map : May Be Used at Disposable Airlines Module
    elseif ($type === 'airline') {
      $where['airline_id'] = $airline_id;
      $mapflights = Flight::with($eager_load)->where($where)->orderby('flight_number')->get();
    }

    // Airport Flights Map : May Be Used at Disposable Hubs Module or with Generic Airport Details Page
    elseif ($type === 'airport') {
      $where['dpt_airport_id'] = $airport_id;
      $mapflights = Flight::with($eager_load)->where($where)->orWhere('arr_airport_id', $airport_id)->where($orwhere)->get();
    }

    // Get Fleet
    elseif ($type === 'fleet') {
      $awhere = [];
      $awhere['state'] = AircraftState::PARKED;
      $awhere['status'] = AircraftStatus::ACTIVE;

      $sfwhere = [];
      if (is_numeric($this->config['airline'])) {
        $sfwhere['airline_id'] = $this->config['airline'];
      }

      $subfleets = Subfleet::where($sfwhere)->pluck('id')->toArray();

      // Get User's Allowed Aircraft
      if (setting('pireps.restrict_aircraft_to_rank')) {
        $user_subfleets = $user->rank->subfleets()->pluck('id')->toArray();
        $subfleets = array_intersect($subfleets, $user_subfleets);
      }

      $aircraft = Aircraft::where($awhere)->whereIn('subfleet_id', $subfleets)->orderby('registration')->get();

      // Build Unique Locations
      $aircraft_locations = $aircraft->pluck('airport_id')->toArray();
      $aircraft_locations = array_unique($aircraft_locations, SORT_STRING);
      $airports = Airport::whereIn('id', $aircraft_locations)->get();
    }

    // Get The Flights/Pireps With Applied Limit
    if (is_numeric($this->config['limit']) && $type != 'fleet') {
      $mapflights = $mapflights->take($this->config['limit']);
    }

    // Build Unique City Pairs From Flights/Pireps
    if ($type != 'fleet') {
      $citypairs = [];
      $airports_pack = collect();
      foreach ($mapflights as $mf) {
        $airports_pack->push($mf->dpt_airport);
        $airports_pack->push($mf->arr_airport);
        $reverse = $mf->arr_airport_id.$mf->dpt_airport_id;
        if (Dispo_In_Array_MD($reverse, $citypairs)) { continue; }

        $citypairs[] = array(
          'name' => $mf->dpt_airport_id.$mf->arr_airport_id,
          'dloc' => $mf->dpt_airport->lat.",".$mf->dpt_airport->lon,
          'aloc' => $mf->arr_airport->lat.",".$mf->arr_airport->lon
        );
      }
      $citypairs = Dispo_Array_Unique_MD($citypairs, 'name');
      $airports = $airports_pack->unique('id');
    }

    // Set Map Center to Selected Airport
    if ($type === 'airport') {
      foreach ($airports->where('id', $airport_id) as $center) {
        $mapcenter = $center->lat.",".$center->lon;
      }
    }

    // Map Icons
    $mapIcons = [];

    $RedUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png';
    $GreenUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-green.png';
    $BlueUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-blue.png';
    $YellowUrl = 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-yellow.png';

    $shadowUrl = 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png';
    $iconSize = array(12, 20);
    $shadowSize = array(20, 20);

    $mapIcons['RedIcon'] = json_encode(array('iconUrl' => $RedUrl, 'shadowUrl' => $shadowUrl, 'iconSize' => $iconSize, 'shadowSize' => $shadowSize));
    $mapIcons['GreenIcon'] = json_encode(array('iconUrl' => $GreenUrl, 'shadowUrl' => $shadowUrl, 'iconSize' => $iconSize, 'shadowSize' => $shadowSize));
    $mapIcons['BlueIcon'] = json_encode(array('iconUrl' => $BlueUrl, 'shadowUrl' => $shadowUrl, 'iconSize' => $iconSize, 'shadowSize' => $shadowSize));
    $mapIcons['YellowIcon'] = json_encode(array('iconUrl' => $YellowUrl, 'shadowUrl' => $shadowUrl, 'iconSize' => $iconSize, 'shadowSize' => $shadowSize));

    // Routes For PopUps
    $hroute = Dispo_Modules('DisposableHubs') ? 'DisposableHubs.hshow' : 'frontend.airports.show';
    $aroute = Dispo_Modules('DisposableAirlines') ? 'DisposableAirlines.daircraft' : null;

    // Map Hubs Array
    $mapHubs = [];

    foreach ($airports->where('hub', 1) as $hub) {
      $hpop = '<a href="'.route($hroute, [$hub->id]).'" target="_blank">'.$hub->id.' '.str_replace("'","`",$hub->name).'</a>';
      if (isset($aircraft) && isset($aroute) && $aircraft->where('airport_id', $hub->id)->count() > 0 && $aircraft->where('airport_id', $hub->id)->count() < 6) {
        $hpop = $hpop.'<hr>';
        foreach ($aircraft->where('airport_id', $hub->id) as $ac) {
          $hpop = $hpop.'<a href="'.route($aroute, [$ac->registration]).'" target="_blank">'.$ac->registration.' ('.$ac->icao.')</a><br>';
        }
      } elseif (isset($aircraft)) {
        $hpop = $hpop.'<hr>Parked Aircraft: '.$aircraft->where('airport_id', $hub->id)->count().'<br>';
      }
      $mapHubs[] = [
        'id'  => $hub->id,
        'loc' => $hub->lat.', '.$hub->lon,
        'pop' => $hpop,
      ];
    }

    // Map Airport Array
    $mapAirports = [];

    foreach ($airports->where('hub', 0) as $airport) {
      $apop = '<a href="'.route('frontend.airports.show', [$airport->id]).'" target="_blank">'.$airport->id.' '.str_replace("'","`",$airport->name).'</a>';
      if (isset($aircraft) && isset($aroute) && $aircraft->where('airport_id', $airport->id)->count() > 0 && $aircraft->where('airport_id', $airport->id)->count() < 6) {
        $apop = $apop.'<hr>';
        foreach ($aircraft->where('airport_id', $airport->id) as $ac) {
          $apop = $apop.'<a href="'.route($aroute, [$ac->registration]).'" target="_blank">'.$ac->registration.' ('.$ac->icao.')</a><br>';
        }
      } elseif (isset($aircraft)) {
        $apop = $apop.'<hr>Parked Aircraft: '.$aircraft->where('airport_id', $airport->id)->count();
      }
      $mapAirports[] = [
        'id'  => $airport->id,
        'loc' => $airport->lat.', '.$airport->lon,
        'pop' => $apop,
      ];
    }

    // Map CityPairs Array
    $mapCityPairs = [];

    if (isset($citypairs)) {
      foreach ($citypairs as $citypair) {
        $popuptext = '';

        foreach ($mapflights->where('dpt_airport_id', substr($citypair['name'],0,4))->where('arr_airport_id', substr($citypair['name'],4,4)) as $mf) {
          if ($type === 'user') {
            $popuptext = $popuptext.'<a href="/pireps/';
          } else {
            $popuptext = $popuptext.'<a href="/flights/';
          }
          $popuptext = $popuptext.$mf->id.'" target="_blank"><b>';
          $popuptext = $popuptext.$mf->airline->iata.$mf->flight_number.' '.$mf->dpt_airport_id.'-'.$mf->arr_airport_id.'</b></a><br>';
        }

        foreach ($mapflights->where('dpt_airport_id', substr($citypair['name'],4,4))->where('arr_airport_id',substr($citypair['name'],0,4)) as $mf) {
          if ($type === 'user') {
            $popuptext = $popuptext.'<a href="/pireps/';
          } else {
            $popuptext = $popuptext.'<a href="/flights/';
          }
          $popuptext = $popuptext.$mf->id.'" target="_blank"><b>';
          $popuptext = $popuptext.$mf->airline->iata.$mf->flight_number.' '.$mf->dpt_airport_id.'-'.$mf->arr_airport_id.'</b></a><br>';
        }

        if ($user_citypairs->contains($citypair['name'])) {
          $cp_color = 'darkgreen';
        } elseif ($user_citypairs->contains(substr($citypair['name'],4,4).substr($citypair['name'],0,4))) {
          $cp_color = 'lightgreen';
        } else {
          $cp_color = 'crimson';
        }

        $mapCityPairs[] = [
          'name' => $citypair['name'],
          'geod' => '['.$citypair['dloc'].'], ['.$citypair['aloc'].']',
          'geoc' => $cp_color,
          'pop'  => $popuptext,
        ];
      }
    }

    return view('DisposableTools::flights_map',[
      'mapcenter'    => $mapcenter,
      'mapsource'    => $type,
      'aircraft'     => isset($aircraft) ? count($aircraft) : null,
      'flights'      => isset($mapflights) ? count($mapflights) : null,
      'mapIcons'     => $mapIcons,
      'mapHubs'      => $mapHubs,
      'mapAirports'  => $mapAirports,
      'mapCityPairs' => $mapCityPairs,
      ]
    );
  }
}
