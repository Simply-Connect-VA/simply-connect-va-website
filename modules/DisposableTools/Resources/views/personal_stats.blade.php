@if($config['disp'] === 'full')
  <div class="card mb-2 text-center">
    <div class="card-body p-1">
      <h5 class="m-1 p-0">
        @if(is_numeric($pstat) && ($config['type'] === 'avgtime' || $config['type'] === 'tottime'))
          @minutestotime($pstat)
        @else
          {{ $pstat }}
        @endif
      </h5>
    </div>
    <div class="card-footer p-1">
      {{ $sname }} {{ $speriod }}
    </div>
  </div>
@else
  @if(is_numeric($pstat) && ($config['type'] === 'avgtime' || $config['type'] === 'tottime'))
    @minutestotime($pstat)
  @else
    {{ $pstat }}
  @endif
@endif