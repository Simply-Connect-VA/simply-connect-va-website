<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 3, 'period' => 'prevm'])
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'time', 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'type' => 'time', 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 3, 'type' => 'time', 'period' => 'prevm'])
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'distance', 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'type' => 'distance', 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 3, 'type' => 'distance', 'period' => 'prevm'])
</div>
