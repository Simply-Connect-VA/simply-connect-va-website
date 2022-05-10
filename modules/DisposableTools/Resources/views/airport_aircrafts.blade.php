<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('DisposableTools::common.aclist')
      <i class="fas fa-plane float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0 overflow-auto">
    @if(!$aircraft->count())
      <span class="text-center m-1">@lang('DisposableTools::common.nothing')</span>
    @else
      <table class="table table-sm table-striped table-borderless mb-0 text-center">
        <tr>
          <th class="text-left">@lang('DisposableTools::common.reg')</th>
          <th>ICAO @lang('DisposableTools::common.type')</th>
          <th>@lang('common.airline')</th>
          <th>@lang('common.subfleet')</th>
        </tr>
        @foreach($aircraft as $ac)
          <tr>
            @if (Dispo_Modules('DisposableAirlines') && isset($ac->registration) && isset($ac->subfleet->airline->icao) && isset($ac->subfleet->type))
              <td class="text-left"><a href="{{ route('DisposableAirlines.daircraft', [$ac->registration]) }}">{{ $ac->registration }}</a></td>
              <td>{{ $ac->icao ?? '' }}</td>
              <td><a href="{{ route('DisposableAirlines.ashow', [$ac->subfleet->airline->icao]) }}">{{ $ac->subfleet->airline->name }}</a></td>
              <td><a href="{{ route('DisposableAirlines.dsubfleet', [$ac->subfleet->type]) }}">{{ $ac->subfleet->name }}</a></td>
            @else
              <td class="text-left">{{ $ac->registration ?? '' }}</td>
              <td>{{ $ac->icao ?? '' }}</td>
              <td>{{ $ac->subfleet->airline->name ?? '' }}</td>
              <td>{{ $ac->subfleet->name ?? '' }}</td>
            @endif
          </tr>
        @endforeach
      </table>
    @endif
  </div>
  <div class="card-footer p-1 text-right">
    <span class="m-0 p-0">@lang('DisposableTools::common.total') : {{ number_format($aircraft->count()) }}</span>
  </div>
</div>
