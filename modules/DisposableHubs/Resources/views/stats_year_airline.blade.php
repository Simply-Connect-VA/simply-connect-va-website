<div class="col">
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'period' => 'currenty'])
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'period' => 'lasty'])
</div>
<div class="col">
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'time', 'period' => 'currenty'])
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'type' => 'time', 'period' => 'lasty'])
</div>
<div class="col">
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 5, 'type' => 'distance', 'period' => 'currenty'])
    @widget('Modules\DisposableTools\Widgets\TopAirlines', ['count' => 4, 'type' => 'distance', 'period' => 'lasty'])
</div>

