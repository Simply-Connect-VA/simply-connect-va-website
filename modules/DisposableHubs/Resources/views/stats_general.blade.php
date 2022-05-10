<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5])
  @if($TotalAirlines > 1)
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5])
  @endif
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'time'])
  @if($TotalAirlines > 1)
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'time'])
  @endif
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'distance'])
  @if($TotalAirlines > 1)
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'distance'])
  @endif
</div>

