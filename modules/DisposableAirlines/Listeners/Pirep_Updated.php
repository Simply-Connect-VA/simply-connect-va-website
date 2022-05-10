<?php

namespace Modules\DisposableAirlines\Listeners;

use App\Events\PirepUpdated;
use App\Models\Enums\AircraftState;
use App\Models\Enums\PirepStatus;
use Illuminate\Support\Facades\Log;

class Pirep_Updated
{
  // Listen PirepFiled Event
  // To Change Aircraft State : IN_AIR or IN_USE
  // According to Pirep Status (Boarding, TakeOff, Landed)
  public function handle(PirepUpdated $event)
  {
    if (Dispo_Settings('dairlines.acstate_control') && $event->pirep->aircraft) {
      $pirep = $event->pirep;
      $aircraft = $pirep->aircraft;
      if ($pirep->status === PirepStatus::BOARDING || $pirep->status === PirepStatus::TAKEOFF || $pirep->status === PirepStatus::LANDED) {

        if ($pirep->status === PirepStatus::BOARDING) {
          $aircraft->state = AircraftState::IN_USE;
          $aircraft->save();
          Log::info('Disposable Airlines, Pirep '.$event->pirep->id.' BOARDING started, Change STATE of '.$aircraft->registration.' to IN USE');
        }

        elseif ($pirep->status === PirepStatus::TAKEOFF) {
          $aircraft->state = AircraftState::IN_AIR;
          $aircraft->save();
          Log::info('Disposable Airlines, Pirep '.$event->pirep->id.' TAKE OFF reported, Change STATE of '.$aircraft->registration.' to IN AIR');
        }

        elseif ($pirep->status === PirepStatus::LANDED) {
          $aircraft->state = AircraftState::IN_USE;
          $aircraft->save();
          Log::info('Disposable Airlines, Pirep '.$event->pirep->id.' LANDING reported, Change STATE of '.$aircraft->registration.' to IN USE');
        }
      }
    }
  }
}
