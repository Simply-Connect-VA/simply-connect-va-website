<?php

namespace Modules\DisposableAirlines\Listeners;

use App\Events\PirepPrefiled;
use App\Models\Enums\AircraftState;
use Illuminate\Support\Facades\Log;

class Pirep_Prefiled
{
  // Listen PirepPrefiled Event
  // To Change Aircraft State : IN_USE
  // Do this only for MANUAL Pireps ! ACARS Pireps will use Pirep Updated Event
  public function handle(PirepPrefiled $event)
  {
    if (Dispo_Settings('dairlines.acstate_control') && $event->pirep->aircraft && $event->pirep->source === 0) {
      $aircraft = $event->pirep->aircraft;
      $aircraft->state = AircraftState::IN_USE;
      $aircraft->save();
      Log::info('Disposable Airlines, Pirep '.$event->pirep->id.' PRE-FILED, Change STATE of '.$aircraft->registration.' to IN USE');
    }
  }
}
