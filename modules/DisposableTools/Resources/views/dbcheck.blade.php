@extends('admin.app')
@section('title', 'Disposable Database Check')

@section('content')
  <div class="card border-blue-bottom">
    <div class="content">
      <p>Below you will see some check results, which may result various errors in your phpVMS v7</p>
      <hr>
      <p>If you have anything greater than 0 (zero) here, specially in Pirep checks most likely you will have <b>"unable to get property ... of non-object"</b> errors.</p>
      <p>Flight and Subfleet checks may be tolerable up to a point, but they carry the same risk as Pireps too.</p>
      <p>Acars entry counts is just for info, they are harmless but they are using up database space for no good use.</p>
      <br>
      <p>
        You need to fix those errors via your database workbench (like phpMyAdmin etc) if necessary, 
        this page only gives you relevant ID's to check manually (or to use in your SQL Queries), 
        it DOES NOT offer any "one click" fixes.
      </p> 
      <hr>
      <p>By <a href="https://github.com/FatihKoz" target="_blank">B.Fatih KOZ</a> &copy; @php echo date('Y'); @endphp</p>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-12">
      <h5 style="margin:5px; padding:5px;"><b>Checks</b></h5>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($pirep_user) }}
        <br>
        <span class="text-danger"><b>Pireps associated with HARD DELETED users</b></span>
        @if(count($pirep_user) > 0)
          <hr>
          @foreach($pirep_user as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($pirep_comp) }}
        <br>
        <span class="text-danger"><b>Pireps associated with DELETED airlines</b></span>
        @if(count($pirep_comp) > 0)
          <hr>
          @foreach($pirep_comp as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($pirep_acft) }}
        <br>
        <span class="text-danger"><b>Pireps associated with DELETED aircraft</b></span>
        @if(count($pirep_acft) > 0)
          <hr>
          @foreach($pirep_acft as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        Dep: {{ count($pirep_orig) }} / Arr: {{ count($pirep_dest) }}
        <br>
        <span class="text-danger"><b>Pireps associated with DELETED airports</b></span>
        @if(count($pirep_orig) > 0)
          <hr>
          Check Departures
          <br>
          @foreach($pirep_orig as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
        @if(count($pirep_dest) > 0)
          <hr>
          Check Arrivals
          <br>
          @foreach($pirep_dest as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($users_comp) }}
        <br>
        <span class="text-danger"><b>Users associated with DELETED airlines</b></span>
        @if(count($users_comp) > 0)
          <hr>
          @foreach($users_comp as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($fleet_comp) }}
        <br>
        <span class="text-danger"><b>Subfleets associated with DELETED airlines</b></span>
        @if(count($fleet_comp) > 0)
          <hr>
          @foreach($fleet_comp as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($flight_comp) }}
        <br>
        <span class="text-danger"><b>Flights associated with DELETED airlines</b></span>
        @if(count($flight_comp) > 0)
          <hr>
          @foreach($flight_comp as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        Dep: {{ count($flight_orig) }} / Arr: {{ count($flight_dest) }}
        <br>
        <span class="text-danger"><b>Flights associated with DELETED airports</b></span>
        @if(count($flight_orig) > 0)
          <hr>
          <b>Check Departures</b>
          <br>
          @foreach($flight_orig as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
        @if(count($flight_dest) > 0)
          <hr>
          <b>Check Arrivals</b>
          <br>
          @foreach($flight_dest as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($users_field) }}
        <br>
        <span class="text-danger" title="User Field Values"><b>Entries associated with HARD DELETED users</b></span>
        @if(count($users_field) > 0)
          <hr>
          @foreach($users_field as $list){{ $list }}@if(!$loop->last){{ ', ' }}@endif @endforeach
        @endif
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card border-blue-bottom" style="padding:10px;">
        {{ count($acars_pirep) }}
        <br>
        <span class="text-danger"><b>Acars data entries associated with DELETED pireps</b></span>
      </div>
    </div>
  </div>
@endsection
