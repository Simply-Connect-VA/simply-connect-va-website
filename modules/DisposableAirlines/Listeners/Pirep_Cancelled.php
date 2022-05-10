<?php

namespace Modules\DisposableAirlines\Listeners;

use App\Events\PirepCancelled;
use App\Models\Enums\AircraftState;
use Illuminate\Support\Facades\Log;

class Pirep_Cancelled
{
  // Listen PirepCancelled Event
  // To Change Aircraft State : PARKED (On Ground)
  public function handle(PirepCancelled $event)
  {
    if (Dispo_Settings('dairlines.acstate_control') && $event->pirep->aircraft) {
      $aircraft = $event->pirep->aircraft;
      $aircraft->state = AircraftState::PARKED;
      $aircraft->save();
      Log::info("'Disposable Airlines: Pirep ".$event->pirep->id." CANCELLED, Change STATE of ".$aircraft->registration." to ON GROUND'");
    }
  }
}
