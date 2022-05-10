<?php

namespace Modules\DisposableTech\Http\Controllers;

use App\Contracts\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laracasts\Flash\Flash;
use Modules\DisposableTech\Models\Disposable_Tech;

class TechFlapsController extends Controller
{
  // Admin Flaps Page
  public function dtech(Request $request) {

    if ($request->input('deleteflaps')) {
      $flap = Disposable_Tech::where('id', $request->input('deleteflaps'))->first();
      if (!$flap) {
        Flash::error('Record Not Found !');
        return redirect(route('DisposableTech.techadmin'));
      } else {
        $flap->delete();
        $flap = null;
        Flash::warning('Record Deleted !');
      }
    }

    //Get Aircraft ICAO List
    $flaps = Disposable_Tech::orderby('icao')->get();
    $defined_icaotypes = $flaps->pluck('icao')->all();
    $icao = DB::table('aircraft')->select('icao')->whereNotIn('icao', $defined_icaotypes)->groupby('icao')->orderby('icao')->get();

    if ($request->input('editflaps')) {
      $flap = Disposable_Tech::where('id', $request->input('editflaps'))->first();
      if (!$flap)
      {
        Flash::error('Record Not Found !');
        return redirect(route('DisposableTech.techadmin'));
      }
    }

    return view('DisposableTech::admin_acflaps',[
      'icao'  => $icao,
      'flaps' => $flaps,
      'flap'  => isset($flap) ? $flap : null,
    ]);
  }

  // Save or Update Records
  public function dstoretech(Request $request) {

    if (!$request->icao) {
      Flash::error('ICAO Type Code Is Required !');
      return redirect(route('DisposableTech.techadmin'));
    }

    Disposable_Tech::updateOrCreate(
      [
        'icao' => $request->icao,
      ],
      [
        'f0_name'      => $request->f0_name,
        'f0_speed'     => $request->f0_speed,
        'f1_name'      => $request->f1_name,
        'f1_speed'     => $request->f1_speed,
        'f2_name'      => $request->f2_name,
        'f2_speed'     => $request->f2_speed,
        'f3_name'      => $request->f3_name,
        'f3_speed'     => $request->f3_speed,
        'f4_name'      => $request->f4_name,
        'f4_speed'     => $request->f4_speed,
        'f5_name'      => $request->f5_name,
        'f5_speed'     => $request->f5_speed,
        'f6_name'      => $request->f6_name,
        'f6_speed'     => $request->f6_speed,
        'f7_name'      => $request->f7_name,
        'f7_speed'     => $request->f7_speed,
        'f8_name'      => $request->f8_name,
        'f8_speed'     => $request->f8_speed,
        'f9_name'      => $request->f9_name,
        'f9_speed'     => $request->f9_speed,
        'f10_name'     => $request->f10_name,
        'f10_speed'    => $request->f10_speed,
        'gear_extend'  => $request->gear_extend,
        'gear_retract' => $request->gear_retract,
        'gear_maxtire' => $request->gear_maxtire,
        'max_pitch'    => $request->max_pitch,
        'max_roll'     => $request->max_roll,
        'max_cycle_a'  => $request->max_cycle_a,
        'max_time_a'   => $request->max_time_a,
        'duration_a'   => $request->duration_a,
        'max_cycle_b'  => $request->max_cycle_b,
        'max_time_b'   => $request->max_time_b,
        'duration_b'   => $request->duration_b,
        'max_cycle_c'  => $request->max_cycle_c,
        'max_time_c'   => $request->max_time_c,
        'duration_c'   => $request->duration_c,
        'avg_fuel'     => $request->avg_fuel,
        'active'       => $request->active,
      ]
    );

    Flash::success('Technical Details Saved');
    return redirect(route('DisposableTech.dtech'));
  }
}
