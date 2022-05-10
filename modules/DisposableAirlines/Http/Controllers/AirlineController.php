<?php

namespace Modules\DisposableAirlines\Http\Controllers;

use App\Contracts\Controller;
use App\Models\Airline;
use App\Models\Pirep;
use App\Models\User;
use App\Models\Enums\PirepState;
use Illuminate\Support\Facades\DB;
use League\ISO3166\ISO3166;
use Nwidart\Modules\Facades\Module;

class AirlineController extends Controller
{
  // Airlines
  public function aindex()
  {
    $airlines = Airline::where('active',1)->get();

    if (!$airlines) {
      flash()->error('No Active Airlines Found !');
      return redirect(route('frontend.dashboard.index'));
    }

    if ($airlines->count() === 1) {
      $airline = $airlines->first();
      return redirect(route('DisposableAirlines.ashow', [$airline->icao]));
    }

    return view('DisposableAirlines::airlines', [
      'airlines' => $airlines,
      'country'  => new ISO3166(),
    ]);
  }

  // Airline Details
  public function ashow($icao)
  {
    $airline = Airline::with('journal', 'subfleets.aircraft')->where('icao', $icao)->first();

    if (!$airline) {
      flash()->error('Airline Not Found !');
      return redirect(route('DisposableAirlines.aindex'));
    }

    $DisposableTools = Module::find('DisposableTools');
    if ($DisposableTools) {
      $DisposableTools = $DisposableTools->isEnabled();
    }

    $DisposableHubs = Module::find('DisposableHubs');
    if ($DisposableHubs) {
      $DisposableHubs = $DisposableHubs->isEnabled();
    }

    $pilot_where = [];
    $pilot_where['airline_id'] = $airline->id;

    if (setting('pilots.hide_inactive')) {
      $pilot_where['state'] = 1;
    }

    $pilots = User::with('current_airport', 'home_airport')->where($pilot_where)->orderby('id')->get();
    $pireps = Pirep::with('aircraft', 'dpt_airport', 'arr_airport', 'user')->where('airline_id', $airline->id)->where('state', '!=', PirepState::IN_PROGRESS)->orderby('submitted_at', 'desc')->paginate(50);
    $income = DB::table('journal_transactions')->where('journal_id', $airline->journal->id)->sum('credit');
    $expense = DB::table('journal_transactions')->where('journal_id', $airline->journal->id)->sum('debit');
    $balance = $income - $expense;

    return view('DisposableAirlines::airline', [
      'disptools' => $DisposableTools,
      'disphubs'  => $DisposableHubs,
      'airline'   => $airline,
      'income'    => $income,
      'expense'   => $expense,
      'balance'   => $balance,
      'users'     => $pilots,
      'pireps'    => $pireps,
      'country'   => new ISO3166(),
    ]);
  }
}
