<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 10, 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'period' => 'prevm'])
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 10, 'type' => 'time', 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'time', 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'time', 'period' => 'prevm'])
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 10, 'type' => 'distance', 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'distance', 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'distance', 'period' => 'prevm'])
</div>
<div class="col">
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 10, 'type' => 'landingrate', 'period' => 'currentm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'landingrate', 'period' => 'lastm'])
  @widget('Modules\DisposableTools\Widgets\TopPilots', ['count' => 5, 'type' => 'landingrate', 'period' => 'prevm'])
</div>