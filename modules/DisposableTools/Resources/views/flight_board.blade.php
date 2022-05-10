@if($flights->count())
  <div class="card mb-2">
    <div class="card-header p-1">
      <h5 class="m-1 p-0">
        @lang('DisposableTools::common.activef')
        <i class="fas fa-paper-plane float-right"></i>
      </h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-sm table-borderless table-striped mb-0 text-center">
        <tr>
          <th class="text-left" style="width: 50px;">@lang('common.airline')</th>
          <th class="text-left">@lang('DisposableTools::common.flight')</th>
          <th class="text-left">@lang('DisposableTools::common.orig')</th>
          <th class="text-left">@lang('DisposableTools::common.dest')</th>
          <th>@lang('common.aircraft')</th>
          <th>@lang('widgets.livemap.altitude')</th>
          <th>@lang('DisposableTools::common.speed')</th>
          <th>@lang('common.status')</th>
          <th class="text-right">@lang('DisposableTools::common.pilot')</th>
        </tr>
        @foreach($flights as $flight)
          <tr>
            <td class="text-left align-middle" style="width: 50px;">
              @if(filled($flight->airline->logo))
                <img src="{{ $flight->airline->logo }}" style="max-height: 30px;">
              @else
                {{ $flight->airline->name }}
              @endif
            </td>
            <td class="text-left align-middle">
              @ability('admin', 'admin-access')
                <a href="{{ route('frontend.pireps.show', [$flight->id]) }}"><i class="fas fa-info-circle mr-1" title="View Live Pirep"></i></a>
              @endability
              <span title="@if(filled($flight->route_code)){{ 'Code '.$flight->route_code }}@endif @if(filled($flight->route_leg)){{ ' Leg #'.$flight->route_leg }}@endif">
                {{ $flight->airline->code.' '.$flight->flight_number }}
              </span>
            </td>
            <td class="text-left align-middle">
              <span title="{{ optional($flight->dpt_airport)->iata.' '.optional($flight->dpt_airport)->name }}">{{ $flight->dpt_airport_id }}</span>
            </td>
            <td class="text-left align-middle">
              <span title="{{ optional($flight->arr_airport)->iata.' '.optional($flight->arr_airport)->name }}">{{ $flight->arr_airport_id }}</span>
            </td>
            <td class="align-middle">
              @if(Dispo_Modules('DisposableAirlines'))
                <a href="{{ route('DisposableAirlines.daircraft', [$flight->aircraft->registration]) }}">
                  {{ $flight->aircraft->registration.' ('.$flight->aircraft->icao.')' }}
                </a>
              @else
                {{ $flight->aircraft->registration.' ('.$flight->aircraft->icao.')' }}
              @endif
            </td>
            <td class="align-middle">{{ optional($flight->position)->altitude.' ft' }}</td>
            <td class="align-middle">{{ optional($flight->position)->gs.' kts' }}</td>
            <td class="align-middle">{{ PirepStatus::label($flight->status) }}</td>
            <td class="text-right align-middle">
              <a href="{{ route('frontend.profile.show', [$flight->user_id]) }}">{{ $flight->user->name_private }}</a>
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@endif
