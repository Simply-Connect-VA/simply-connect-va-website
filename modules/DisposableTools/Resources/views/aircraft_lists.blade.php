<div class="card mb-2">
  <div class="card-header p-1">
    <h5 class="m-1 p-0">
      @lang('DisposableTools::common.aclist') | {{ ucwords($config['type']) }}
      <i class="fas fa-plane float-right"></i>
    </h5>
  </div>
  <div class="card-body p-0">
    <table class="table table-sm table-borderless mb-0 text-left">
      <tr>
        <th>
          @if ($config['type'] === 'icao') 
            ICAO @lang('DisposableTools::common.type')
          @else 
            @lang('DisposableTools::common.location')
          @endif
        </th>
        <th class="text-right"><span class="mr-2">@lang('DisposableTools::common.count')</span></th>
      </tr>
    </table>
  </div>
  <div class="card-body p-0 overflow-auto">
    <table class="table table-sm table-striped table-borderless mb-0 text-left">
      @foreach ($aircraft as $ac)
        <tr>
          <td class="align-middle">
            @if ($config['type'] === 'icao') 
              {{ $ac->icao }}
            @else 
              <a href="{{route('frontend.airports.show', [$ac->airport_id])}}">{{ $ac->airport->name ?? $ac->airport_id }}</a>
              @if (optional($ac->airport)->hub == 1) <i class="fas fa-home ml-1 mr-1 float-right"></i> @endif
            @endif
          </td>
          <td class="text-right">{{ $ac->result }}</td>
        </tr>
      @endforeach
    </table>
  </div>
</div>
