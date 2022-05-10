<?php

namespace Modules\DisposableRanks\Http\Controllers;

use App\Contracts\Controller;
use App\Models\Rank;
use Nwidart\Modules\Facades\Module;

class DispoRanksController extends Controller
{
  // Ranks
  public function ranks()
  {
    $DisposableAirlines = Module::find('DisposableAirlines');
    if($DisposableAirlines) {
      $DisposableAirlines = $DisposableAirlines->isEnabled();
    }

    $ranks = Rank::with('subfleets.airline', 'subfleets.aircraft')->orderby('hours')->get();

    return view('DisposableRanks::ranks',[
      'ranks'  => $ranks,
      'dispal' => $DisposableAirlines,
    ]);
  }
}
