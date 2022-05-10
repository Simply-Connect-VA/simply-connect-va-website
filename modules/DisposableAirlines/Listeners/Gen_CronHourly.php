<?php

namespace Modules\DisposableAirlines\Listeners;

use App\Events\CronHourly;
use App\Models\Aircraft;
use App\Models\Enums\AircraftState;
use App\Models\Enums\PirepState;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class Gen_CronHourly
{
  public function handle(CronHourly $event)
  {
    $this->ReleaseStuckAircraft();
  }

  public function ReleaseStuckAircraft()
  {
    // Get active pireps/flights as an array
    $active_pireps = DB::table('pireps')->select('aircraft_id')->where('state', PirepState::IN_PROGRESS)->orWhere('state', PirepState::PAUSED)->pluck('aircraft_id')->toArray();
    // Get non parked aircraft which are not in the active pireps/flights array
    $active_aircraft = Aircraft::where('state', '!=', AircraftState::PARKED)->whereNotIn('id', $active_pireps)->get();
    // Park them with a log entry for each
    foreach ($active_aircraft as $aircraft) {
      $aircraft->state = AircraftState::PARKED;
      $aircraft->save();
      Log::debug('CRON, Disposable Airlines '.$aircraft->registration.' state changed to PARKED');
    }
  }
}
