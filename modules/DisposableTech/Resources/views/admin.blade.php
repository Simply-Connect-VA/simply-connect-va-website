@extends('admin.app')
@section('title', 'Disposable Tech Specs and Runways')

@section('content')
  <div class="card border-blue-bottom" style="margin-left:5px; margin-right:5px; margin-bottom:5px;">
    <div class="content">
      <p>This module is designed to provide aircraft technical details, specifications and runway information, mainly for SimBrief usage.<br>
      <p><b>Details about the module can be found in the README.md file</b></p>
      <p>&bull; <a href="https://github.com/FatihKoz/DisposableTech#readme" target="_blank">Online Readme</a></p>
      <hr>
      <p>Module Developed by <a href="https://github.com/FatihKoz" target="_blank">B.Fatih KOZ</a> &copy; 2021</p>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-12">
        <h4 style="margin:5px;"><b>Admin Functions</b></h4><hr>
      <div class="col-sm-1">
        {{-- Intentionally Left Blank --}}
      </div>
      <div class="col-sm-5">
        <div class="card border-blue-bottom" style="padding:10px;">
            <a href="{{ route('DisposableTech.dspecs')}}">Define ICAO Type, Subfleet or Aircraft Specs</a>
            <br><br>
            Specs will be shown at Aircraft details and Subfleet listing pages, also they may be used for detailed SimBrief Flight planning.
        </div>
      </div>
      <div class="col-sm-5">
        <div class="card border-blue-bottom" style="padding:10px;">
            <a href="{{ route('DisposableTech.dtech')}}">Define Maintenance Periods, Pitch, Roll, Flap and Gear Limits</a>
            <br><br>
            Tech details, Flap and Gear Speeds may be used for Pirep evaluation purposes.
        </div>
      </div>
      <div class="col-sm-1">
        {{-- Intentionally Left Blank --}}
      </div>
    </div>
  </div>
@endsection
