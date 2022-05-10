{{-- LEFT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          <i class="fas fa-users float-right"></i>
          @lang('DisposableHubs::common.hubplt')
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped text-center mb-0" id="hub-users-table">
          <tr>
            <th class="text-left">@lang('common.name')</th>
            <th>@lang('common.country')</th>
            <th class="text-left">@lang('common.airline')</th>
            <th>@lang('DisposableHubs::common.location')</th>
            <th>{{ trans_choice('common.flight',2) }}</th>
          </tr>
          @foreach($hpilots->sortBy('id') as $pilot)
            <tr>
              <td class="text-left">
                <a href="{{ route('frontend.users.show.public', [$pilot->id]) }}">{{ $pilot->name_private }}</a>
              </td>
              <td>
                @if(filled($pilot->country))
                  <span class="flag-icon flag-icon-{{ $pilot->country }}" title="{{ $country->alpha2($pilot->country)['name'] }}"></span>
                @endif
              </td>
              <td class="text-left">
                {{ $pilot->airline->name }}
              </td>
              <td>
                @if($pilot->current_airport)
                  <a href="{{ route('frontend.airports.show', [$pilot->curr_airport_id]) }}">{{ $pilot->curr_airport_id }}</a>
                @endif
              </td>
              <td>
                @if($pilot->flights > 0) {{ $pilot->flights }} @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.hubplt'): {{ $hpilots->count() }}</h5>
      </div>
    </div>
  </div>
{{-- RIGHT --}}
  <div class="col">
    <div class="card mb-2">
      <div class="card-header p-1">
        <h5 class="p-0 m-1">
          @lang('DisposableHubs::common.visitplt')
          <i class="fas fa-user-friends float-right"></i>
        </h5>
      </div>
      <div class="card-body p-0 overflow-auto">
        <table class="table table-sm table-borderless table-striped text-center mb-0" id="hub-users-table">
          <tr>
            <th class="text-left">@lang('common.name')</th>
            <th>@lang('common.country')</th>
            <th class="text-left">@lang('common.airline')</th>
            <th>{{ trans_choice('DisposableHubs::common.hub', 1) }}</th>
            <th>{{ trans_choice('common.flight', 2) }}</th>
          </tr>
          @foreach($vpilots->sortBy('id') as $pilot)
            <tr>
              <td class="text-left">
                <a href="{{ route('frontend.users.show.public', [$pilot->id]) }}">{{ $pilot->name_private }}</a>
              </td>
              <td>
                @if(filled($pilot->country))
                  <span class="flag-icon flag-icon-{{ $pilot->country }}" title="{{ $country->alpha2($pilot->country)['name'] }}"></span>
                @endif
              </td>
              <td class="text-left">
                {{ $pilot->airline->name }}
              </td>
              <td>
                @if($pilot->home_airport)
                  <a href="{{ route('frontend.airports.show', [$pilot->home_airport_id]) }}">{{ $pilot->home_airport_id }}</a>
                @endif
              </td>
              <td>
                @if($pilot->flights > 0) {{ $pilot->flights }} @endif
              </td>
            </tr>
          @endforeach
        </table>
      </div>
      <div class="card-footer p-1 text-right">
        <h5 class="m-1 p-0">@lang('DisposableHubs::common.visitplt'): {{ $vpilots->count() }}</h5>
      </div>
    </div>
  </div>
{{-- END --}}
