{{-- LEFT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          <i class="fas fa-plane float-right"></i>
          @lang('DisposableHubs::common.hubac')
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped text-center mb-0" id="hub-ac-table">
          <tr>
            <th class="text-left">@lang('DisposableHubs::common.reg')</th>
            <th>ICAO @lang('DisposableHubs::common.type')</th>
            <th class="text-left">@lang('common.airline')</th>
            <th>@lang('DisposableHubs::common.location')</th>
            <th>@lang('DisposableHubs::common.ftime')</th>
            <th>@lang('DisposableHubs::common.lastlnd')</th>
          </tr>
          @foreach($haircrafts->sortBy('registration') as $ac)
            <tr>
              <td class="text-left">{{ $ac->registration }}</td>
              <td>{{ $ac->icao }}</td>
              <td class="text-left">{{ $ac->subfleet->airline->name }}</td>
              <td>
                @if($ac->airport_id)
                  <a href="{{route('frontend.airports.show', [$ac->airport_id])}}">{{ $ac->airport_id }}</a>
                @endif
              </td>
              <td>
                @if($ac->flight_time > 0)
                  @minutestotime($ac->flight_time)
                @endif
              </td>
              <td>
                @if($ac->landing_time)
                  {{ Carbon::parse($ac->landing_time)->diffForHumans() }}
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.hubac'): {{ $haircrafts->count() }}</h5>
      </div>
    </div>
  </div>
{{-- RIGHT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          @lang('DisposableHubs::common.visitac')
          <i class="fas fa-paper-plane float-right"></i>
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped mb-0 text-center"  id="visiting-ac-table">
          <tr>
            <th class="text-left">@lang('DisposableHubs::common.reg')</th>
            <th>ICAO @lang('DisposableHubs::common.type')</th>
            <th class="text-left">@lang('common.airline')</th>
            <th>{{ trans_choice('DisposableHubs::common.hub', 1) }}</th>
            <th>@lang('DisposableHubs::common.ftime')</th>
            <th>@lang('DisposableHubs::common.lastlnd')</th>
          </tr>
          @foreach($vaircrafts->sortBy('registration') as $ac)
            <tr>
              <td class="text-left">{{ $ac->registration }}</td>
              <td>{{ $ac->icao }}</td>
              <td class="text-left">{{ $ac->subfleet->airline->name }}</td>
              <td>
                @if($ac->subfleet->hub_id)
                  <a href="{{ route('DisposableHubs.hshow', [$ac->subfleet->hub_id]) }}">{{ $ac->subfleet->hub_id }}</a>
                @endif
              </td>
              <td>
                @if($ac->flight_time > 0)
                  @minutestotime($ac->flight_time)
                @endif
              </td>
              <td>
                @if($ac->landing_time)
                  {{ Carbon::parse($ac->landing_time)->diffForHumans() }}
                @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.visitac'): {{ $vaircrafts->count() }}</h5>
      </div>
    </div>
  </div>
{{-- END --}}
