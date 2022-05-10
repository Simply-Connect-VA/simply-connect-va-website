@extends('admin.app')
@section('title', 'Disposable Tools and Widgets Module')

@section('content')
  <div class="card border-blue-bottom">
    <div class="content">
      <p>This module is designed to provide multiple widgets and some helper tools for phpVms with basic language support.</p>
      <p><b>Widget list, possible options and usage examples are in the README.md file</b></p>
      <p>&bull; <a href="https://github.com/FatihKoz/DisposableTools#readme" target="_blank">Online Readme</a></p>
      <hr>
      <p>By <a href="https://github.com/FatihKoz" target="_blank">B.Fatih KOZ</a> &copy; @php echo date('Y'); @endphp</p>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-12">
      <h5 style="margin:5px; padding:5px;"><b>Admin Functions & Settings</b></h5>
    </div>
  </div>

  <div class="row text-center" style="margin-left:5px; margin-right:5px;">
    <div class="col-sm-4">
      <div class="card border-blue-bottom" style="padding:10px;">
        <b>IVAO WhazzUp Widget Settings</b>
        <br><br>
        @include('DisposableTools::settings_table_section', [ 'group' => 'IVAO'])
      </div>
    </div>

    <div class="col-sm-4">   
      <div class="card border-blue-bottom" style="padding:10px;">
        <b>VATSIM WhazzUp Widget Settings</b>
        <br><br>
        @include('DisposableTools::settings_table_section', [ 'group' => 'VATSIM'])
      </div>
    </div>

    <div class="col-sm-4">   
      <div class="card border-blue-bottom" style="padding:10px;">
        <a href="/admin/dispodbcheck" target="_blank"><b>Check Database for Possible Errors</b></a>
        <br>
      </div>
    </div>
  </div>
@endsection
