@extends('app')
@section('title', __('DisposableHubs::common.stats'))

@section('content')
  <div class="row">
    <div class="col">
    {{--	<h3 class="card-title">Statistics</h3> --}}
    </div>
  </div>
  {{-- BEGIN OVERALL STATS --}}
    <div class="row row-cols-3">
      {{-- LEFT --}}
      <div class="col">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              <i class="fas fa-sitemap float-right"></i>
              @lang('common.airline')
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0 text-left">
              <tr>
                <th style="width: 50%">@lang('common.active')</th>
                <td class="text-right">{{ $TotalAirlines }}</td>
              </tr>
              <tr>
                <th>@lang('common.inactive')</th>
                <td class="text-right">{{ $TotalinactiveAirlines }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              <i class="fas fa-users float-right"></i>
              {{ trans_choice('common.pilot', 2) }}
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0 text-left">
              <tr>
                <th style="width: 50%"><a href="{{ route('frontend.pilots.index') }}">@lang('common.active')</a></th>
                <td class="text-right">{{ $TotalPilots }}</td>
              </tr>
              <tr>
                <th>@lang('common.inactive')</th>
                <td class="text-right">{{ $TotalinactivePilots }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              <i class="fas fa-plane float-right"></i>
              @lang('common.aircraft')
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0 text-left">
              <tr>
                <th>@lang('common.active')</th>
                <td class="text-right">{{ $TotalAircrafts }}</td>
              </tr>
              <tr>
                <th>@lang('common.inactive')</th>
                <td class="text-right">{{ $TotalinactiveAircrafts }}</td>
              </tr>
              <tr>
                <th style="width: 50%">@lang('common.subfleet')</th>
                <td class="text-right">{{ $TotalSubFleets }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
      {{-- MIDDLE --}}
      <div class="col">
        {{-- ONLY VISIBLE IF DISPOSABLE TOOLS MODULE IS INSTALLED --}}
        @if($disptools)
          @widget('Modules\DisposableTools\Widgets\TopAirports', ['count' => 5, 'type' => 'dep',])
          @widget('Modules\DisposableTools\Widgets\TopAirports', ['count' => 5, 'type' => 'arr',])
        @endif
      </div>
      {{-- RIGHT --}}
      <div class="col">
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              <i class="fas fa-paper-plane float-right"></i>
              {{ trans_choice('DisposableHubs::common.airport', 2) }} & {{ trans_choice('common.flight', 2) }}
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0 text-left">
              <tr>
                <th style="width: 50%">{{ trans_choice('DisposableHubs::common.airport', 2) }}</th>
                <td class="text-right">{{ $TotalAirports }}</td>
              </tr>
              <tr>
                <th><a href="{{ route('DisposableHubs.hindex') }}">{{ trans_choice('DisposableHubs::common.hub', 2) }}</a></th>
                <td class="text-right">{{ $TotalHubs }}</td>
              </tr>
              <tr>
                <th>{{ trans_choice('common.flight', 2) }}</th>
                <td class="text-right">{{ $TotalFlights }}</td>
              </tr>
            </table>
          </div>
        </div>
        <div class="card mb-2">
          <div class="card-header p-1">
            <h5 class="m-1 p-0">
              <i class="fas fa-upload float-right"></i>
              {{ trans_choice('common.pirep', 2) }}
            </h5>
          </div>
          <div class="card-body p-0">
            <table class="table table-sm table-borderless table-striped mb-0 text-left">
              <tr>
                <th style="width: 50%">@lang('DisposableHubs::common.tpirep')</th>
                <td class="text-right">{{ $TotalPireps }}</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.rpirep')</th>
                <td class="text-right">{{ $TotalRejectedPireps }}</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.ftime')</th>
                <td class="text-right">@minutestotime($TotalFlightTime)</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.aftime')</th>
                <td class="text-right">@minutestotime($AvgFlightTime)</td>
              </tr>
              <tr>
                <th>@lang('common.distance')</th>
                <td class="text-right">{{ number_format($TotalDistanceFlown) }} {{ setting('units.distance') }}</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.adist')</th>
                <td class="text-right">{{ number_format($AvgDistance) }} {{ setting('units.distance') }}</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.tfuel')</th>
                <td class="text-right">{{ number_format($TotalFuelUsed) }} {{ setting('units.fuel') }}</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.afuel')</th>
                <td class="text-right">{{ number_format($AvgFuelUsed) }} {{ setting('units.fuel') }}/f</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.hfuel')</th>
                <td class="text-right">{{ number_format($AvgFuelHour) }} {{ setting('units.fuel') }}/h</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.alanding')</th>
                <td class="text-right">{{ round($AvgLandingRate) }} ft/min</td>
              </tr>
              <tr>
                <th>@lang('DisposableHubs::common.ascore')</th>
                <td class="text-right">{{ round($AvgScore) }}</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  {{-- END OVERALL STATS --}}

  {{-- ONLY VISIBLE IF DISPOSABLE TOOLS MODULE IS INSTALLED --}}
  @if($disptools)
    <ul class="nav nav-pills nav-fill mb-2" id="pills-tab" role="tablist">
      <li class="nav-item pr-1 pl-1" role="presentation">
        <a class="nav-link dispo-pills" id="pills-month-tab" data-toggle="pill" href="#pills-month" role="tab" aria-controls="pills-month" aria-selected="true">@lang('DisposableHubs::common.smonth')</a>
      </li>
      @if($TotalAirlines > 1)
        <li class="nav-item pr-1 pl-1" role="presentation">
          <a class="nav-link dispo-pills" id="pills-monthal-tab" data-toggle="pill" href="#pills-monthal" role="tab" aria-controls="pills-monthal" aria-selected="false">@lang('DisposableHubs::common.smonthal')</a>
        </li>
      @endif
      <li class="nav-item pr-1 pl-1" role="presentation">
        <a class="nav-link dispo-pills" id="pills-year-tab" data-toggle="pill" href="#pills-year" role="tab" aria-controls="pills-year" aria-selected="false">@lang('DisposableHubs::common.syear')</a>
      </li>
      @if($TotalAirlines > 1)
        <li class="nav-item pr-1 pl-1" role="presentation">
          <a class="nav-link dispo-pills" id="pills-yearal-tab" data-toggle="pill" href="#pills-yearal" role="tab" aria-controls="pills-yearal" aria-selected="false">@lang('DisposableHubs::common.syearal')</a>
        </li>
      @endif
      <li class="nav-item pr-1 pl-1" role="presentation">
        <a class="nav-link dispo-pills active" id="pills-general-tab" data-toggle="pill" href="#pills-general" role="tab" aria-controls="pills-general" aria-selected="false">@lang('DisposableHubs::common.soverall')</a>
      </li>
    </ul>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade" id="pills-month" role="tabpanel" aria-labelledby="pills-month-tab">
        <div class="row row-cols-3">
          @include('DisposableHubs::stats_month')
        </div>
      </div>
      @if($TotalAirlines > 1)
        <div class="tab-pane fade" id="pills-monthal" role="tabpanel" aria-labelledby="pills-monthal-tab">
          <div class="row row-cols-3">
            @include('DisposableHubs::stats_month_airline')
          </div>
        </div>
      @endif
      <div class="tab-pane fade" id="pills-year" role="tabpanel" aria-labelledby="pills-year-tab">
        <div class="row row-cols-3">
          @include('DisposableHubs::stats_year')
        </div>
      </div>
      @if($TotalAirlines > 1)
        <div class="tab-pane fade" id="pills-yearal" role="tabpanel" aria-labelledby="pills-yearal-tab">
          <div class="row row-cols-3">
            @include('DisposableHubs::stats_year_airline')
          </div>
        </div>
      @endif
      <div class="tab-pane fade show active" id="pills-general" role="tabpanel" aria-labelledby="pills-general-tab">
        <div class="row row-cols-3">
          @include('DisposableHubs::stats_general')
        </div>
      </div>
    </div>
  @endif

  {{-- Custom Style For Inactive Tabs --}}
  <style>
    .dispo-pills { color: black; background-color: lightslategray;}
  </style>
@endsection
