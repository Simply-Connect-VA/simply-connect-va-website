<?php

namespace Modules\DisposableTools\Widgets;

use App\Contracts\Widget;
use App\Models\Airline;
use App\Models\Pirep;
use App\Models\User;
use App\Models\UserField;
use App\Models\UserFieldValue;
use Carbon\Carbon;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\DisposableTools\Models\Disposable_WhazzUp;

// WhazzUp Data Retrieval
class WhazzUpVATSIM extends Widget
{
  // Set Widget Auto Refresh Time (Seconds)
  public $reloadTimeout = 60;

  // Prepare Guzzle
  public function __construct(GuzzleClient $httpClient)
  {
    $this->httpClient = $httpClient;
  }

  // Main Widget Code
  public function run()
  {
    // Network Specific Definitions
    $network_selection = 'VATSIM';
    $user_field = 'cid';
    $server_address = 'https://data.vatsim.net/v3/vatsim-data.json';
    $field_name = $this->GetProfileFieldName($network_selection);
    $refresh_interval = $this->GetRefreshInterval($network_selection);

    $whazzup = Disposable_WhazzUp::where('network', $network_selection)->first();

    if (!$whazzup || $whazzup->updated_at->diffInSeconds() > $refresh_interval) {
      $refresh_check = true;
      $error = 'No Valid Data Found';
      $this->DownloadWhazzUp($network_selection, $server_address);
    }

    if ($whazzup) {
      if (isset($refresh_check)) { $whazzup->refresh(); }
      $pilots = collect(json_decode($whazzup->pilots));
      $pilots = $pilots->whereIn($user_field, $this->NetworkUsersArray($field_name));
      $dltime = isset($whazzup->updated_at) ? $whazzup->updated_at : null;

      $widgetdata = collect();
      foreach ($pilots as $pilot) {
        $user = $this->FindUser($pilot->$user_field);
        $pirep = $this->FindActivePirep(!empty($user) ? $user->id : null);
        $airline_icao = substr($pilot->callsign,0,3);
        $flight_plan = $pilot->flight_plan;
        if ($flight_plan) {
          $flightplan = $flight_plan->aircraft_short.' | '.$flight_plan->departure.' > '.$flight_plan->arrival;
          if (isset($flight_plan->alternate)) {
            $flightplan = $flightplan.' (ALTN: '.$flight_plan->alternate.')';
          }
        } else {
          $flightplan = 'ATC Not Filed Yet !';
        }
        $airline = in_array($airline_icao, $this->AirlinesArray());
        $widgetdata[] = array(
          'user_id'      => isset($user) ? $user->id : null,
          'name'         => isset($user) ? $user->name : null,
          'name_private' => isset($user) ? $user->name_private: null,
          'network_id'   => $pilot->cid,
          'callsign'     => $pilot->callsign,
          'server_name'  => $pilot->server,
          'online_time'  => Carbon::parse($pilot->logon_time)->diffInMinutes(),
          'pirep'        => $pirep,
          'airline'      => $airline,
          'flightplan'   => $flightplan,
        );
      }
    }

    $viewer = User::withCount('roles')->find(Auth::id());
    if (isset($viewer) && $viewer->roles_count > 0) {
      $checks = true;
    }

    return view('DisposableTools::whazzup',[
      'pilots'  => isset($widgetdata) ? $widgetdata : null,
      'error'   => isset($error) ? $error : null,
      'network' => $network_selection,
      'checks'  => isset($checks) ? $checks : null,
      'dltime'  => isset($dltime) ? $dltime : null,
    ]);
  }

  // Get Custom User Profile Field Name
  public function GetProfileFieldName($network_selection = null)
  {
    if ($network_selection === 'IVAO') { $result = Dispo_Settings('dtools.whazzup_ivao_fieldname', 'IVAO'); }
    elseif ($network_selection === 'VATSIM') { $result = Dispo_Settings('dtools.whazzup_vatsim_fieldname', 'VATSIM'); }
    return $result;
  }

  // Get Data Refresh Interval (in Seconds)
  public function GetRefreshInterval($network_selection = null)
  {
    $result = 60;
    if ($network_selection === 'IVAO') { $result = Dispo_Settings('dtools.whazzup_ivao_refresh', 60); }
    elseif ($network_selection === 'VATSIM') { $result = Dispo_Settings('dtools.whazzup_vatsim_refresh', 60); }
    // Both IVAO and VATSIM wants minimum 15 seconds
    if ($result < 15) { $result = 15; }
    return $result;
  }

  // Get Network Users
  public function NetworkUsersArray($field_name = null)
  {
    if (!$field_name) { return null; }
    $userfield = UserField::where('name', $field_name)->first();
    if (!$userfield) { return null; }
    $networkusers = UserFieldValue::where('user_field_id', $userfield->id)->whereNotNull('value')->get();
    if (!$networkusers) { return null; }
    $networkusers = $networkusers->pluck('value')->all();
    return $networkusers;
  }

  // Find The User
  public function FindUser($network_id = null)
  {
    if (!$network_id) { return null; }
    $user = UserFieldValue::with('user')->where('value', $network_id)->first();
    $user = $user->user;
    return $user;
  }

  // Find User's Active Pirep
  public function FindActivePirep($user_id = null)
  {
    if (!$user_id) { return null; }
    $pirep = Pirep::with('aircraft', 'airline', 'user')->where('user_id', $user_id)->where('state', 0)->orderby('updated_at', 'desc')->first();
    return $pirep;
  }

  // Get Airline Codes
  public function AirlinesArray()
  {
    $airlines = Airline::where('active', 1)->get();
    if (!$airlines) { return null; }
    $airlines = $airlines->pluck('icao')->all();
    return $airlines;
  }

  // Download and Update WhazzUp Data with IVAO Specific Sections
  public function DownloadWhazzUp($network_selection = null, $server_address = null)
  {
    if (!$network_selection || !$server_address) { return null; }

    try {
      $response = $this->httpClient->request('GET', $server_address);
      if ($response->getStatusCode() !== 200) {
        Log::error('Disposable Tools: HTTP '.$response->getStatusCode().' Error Occured During WhazzUp Download !');
      }
    } catch (GuzzleException $e) {
      Log::error('Disposable Tools: WhazzUp Download Error | '.$e->getMessage());
      return;
    }

    $whazzupdata = json_decode($response->getBody());
    $whazzup_sections = array(
      'network'      => $network_selection,
      'pilots'       => json_encode($whazzupdata->pilots),
      // 'atcos'        => json_encode($whazzupdata->controllers),
      // 'servers'      => json_encode($whazzupdata->servers),
      // 'rawdata'      => json_encode($whazzupdata),
    );

    return Disposable_WhazzUp::updateOrCreate(['network' => $network_selection], $whazzup_sections);
  }
}
