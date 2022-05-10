{{-- LEFT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          <i class="fas fa-plane-departure float-right"></i>
          @lang('DisposableHubs::common.hubdep')
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped text-center mb-0">
          <tr>
            <th class="text-left">@lang('DisposableHubs::common.flightno')</th>
            <th class="text-left">@lang('DisposableHubs::common.dest')</th>
            <th>@lang('DisposableHubs::common.std')</th>
            <th>@lang('DisposableHubs::common.sta')</th>
          </tr>
          @foreach($deps->sortBy('dpt_time') as $flight)
            <tr>
              <td class="text-left"><a href="{{ route('frontend.flights.show', [$flight->id]) }}">{{ $flight->ident }}</a></td>
              <td class="text-left"><a href="{{ route('frontend.airports.show', [$flight->arr_airport_id]) }}">{{ $flight->arr_airport_id }} {{ $flight->arr_airport->name ?? '' }}</a></td>
              <td>{{ $flight->dpt_time }}</td>
              <td>{{ $flight->arr_time }}</td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.hubdep'): {{ $deps->count() }}</h5>
      </div>
    </div>
  </div>
{{-- RIGHT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          <i class="fas fa-plane-arrival float-right"></i>
          @lang('DisposableHubs::common.hubarr')
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped mb-0 text-center">
          <tr>
            <th class="text-left">@lang('DisposableHubs::common.flightno')</th>
            <th class="text-left">@lang('DisposableHubs::common.orig')</th>
            <th>@lang('DisposableHubs::common.std')</th>
            <th>@lang('DisposableHubs::common.sta')</th>
          </tr>
          @foreach($arrs->sortBy('arr_time') as $flight)
            <tr>
              <td class="text-left"><a href="{{ route('frontend.flights.show', [$flight->id]) }}">{{ $flight->ident }}</a></td>
              <td class="text-left"><a href="{{ route('frontend.airports.show', [$flight->dpt_airport_id]) }}">{{ $flight->dpt_airport_id }} {{ $flight->dpt_airport->name ?? '' }}</a></td>
              <td>{{ $flight->dpt_time }}</td>
              <td>{{ $flight->arr_time }}</td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.hubarr'): {{ $arrs->count() }}</h5>
      </div>
    </div>
  </div>
{{-- END --}}
