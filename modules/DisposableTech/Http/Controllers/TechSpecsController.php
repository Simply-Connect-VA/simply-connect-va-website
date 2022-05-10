<?php

namespace Modules\DisposableTech\Http\Controllers;

use App\Contracts\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Modules\DisposableTech\Models\Disposable_Specs;

class TechSpecsController extends Controller
{
  // Admin Specs Page
  public function dspecs(Request $request) {

    if ($request->input('deletesp')) {
      $specs = Disposable_Specs::where('id', $request->input('deletesp'))->first();
      if (!$specs) {
        Flash::error('Record Not Found !');
        return redirect(route('DisposableTech.techadmin'));
      } else {
        $specs->delete();
        Flash::warning('Record Deleted !');
      }
    }

    if ($request->input('editsp')) {
      $specs = Disposable_Specs::with('aircraft', 'subfleet')->where('id', $request->input('editsp'))->first();
      if (!$specs) {
        Flash::error('Record Not Found !');
        return redirect(route('DisposableTech.techadmin'));
      }
    }

    //Get SubFleet List
    $icaotypes = DB::table('aircraft')->select('icao')->whereNotNull('icao')->groupBy('icao')->orderby('icao')->pluck('icao')->toArray();
    $subfleets = DB::table('subfleets')->select('id', 'name', 'type')->orderby('name')->get();
    $aircraft = DB::table('aircraft')->select('id', 'name', 'registration', 'icao')->orderby('registration')->get();
    $allspecs = Disposable_Specs::with('aircraft', 'subfleet')->get();

    return view('DisposableTech::admin_acspecs',[
      'icaotypes' => $icaotypes,
      'subfleets' => $subfleets,
      'aircraft'  => $aircraft,
      'allspecs'  => $allspecs,
      'specs'     => isset($specs) ? $specs : null,
    ]);
  }

  // Store Specs
  public function dstorespecs(Request $request) {

    if (!$request->aircraft_id && !$request->subfleet_id && !$request->icao_id) {
      Flash::error('Select at least an ICAO Type or Subfleet or Aircraft to record specs !');
      return redirect(route('DisposableTech.techadmin'));
    }

    if (!$request->saircraft) {
      Flash::error('Aircraft Name Field Is Required !');
      return redirect(route('DisposableTech.techadmin'));
    }

    // Create New Record
    Disposable_Specs::updateOrCreate(
      [
        'id'          => $request->id,
      ],[
        'icao_id'     => $request->icao_id,
        'aircraft_id' => $request->aircraft_id,
        'subfleet_id' => $request->subfleet_id,
        'airframe_id' => $request->airframe_id,
        'icao'        => $request->icao,
        'name'        => $request->name,
        'engines'     => $request->engines,
        'bew'         => $request->bew,
        'dow'         => $request->dow,
        'mzfw'        => $request->mzfw,
        'mrw'         => $request->mrw,
        'mtow'        => $request->mtow,
        'mlw'         => $request->mlw,
        'mrange'      => $request->mrange,
        'mceiling'    => $request->mceiling,
        'mfuel'       => $request->mfuel,
        'mpax'        => $request->mpax,
        'mspeed'      => $request->mspeed,
        'cspeed'      => $request->cspeed,
        'cat'         => $request->cat,
        'equip'       => $request->equip,
        'transponder' => $request->transponder,
        'pbn'         => $request->pbn,
        'crew'        => $request->crew,
        'saircraft'   => $request->saircraft,
        'stitle'      => $request->stitle,
        'fuelfactor'  => $request->fuelfactor,
        'cruiselevel' => $request->cruiselevel,
        'paxwgt'      => $request->paxwgt,
        'bagwgt'      => $request->bagwgt,
        'active'      => $request->active,
      ]
    );

    Flash::success('Specifications Saved');
    return redirect(route('DisposableTech.dspecs'));
  }
}
