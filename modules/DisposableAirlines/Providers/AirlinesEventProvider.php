<?php

namespace Modules\DisposableAirlines\Providers;

use App\Events\CronHourly;
use App\Events\PirepCancelled;
use App\Events\PirepFiled;
use App\Events\PirepPrefiled;
use App\Events\PirepUpdated;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\DisposableAirlines\Listeners\Gen_CronHourly;
use Modules\DisposableAirlines\Listeners\Pirep_Cancelled;
use Modules\DisposableAirlines\Listeners\Pirep_Filed;
use Modules\DisposableAirlines\Listeners\Pirep_Prefiled;
use Modules\DisposableAirlines\Listeners\Pirep_Updated;


class AirlinesEventProvider extends ServiceProvider
{
    // Listen Below Events
    protected $listen = [
        CronHourly::class     => [Gen_CronHourly::class],
        PirepCancelled::class => [Pirep_Cancelled::class],
        PirepFiled::class     => [Pirep_Filed::class],
        PirepPrefiled::class  => [Pirep_Prefiled::class],
        PirepUpdated::class   => [Pirep_Updated::class],
    ];

    // Register Module Events
    public function boot()
    {
        parent::boot();
    }
}
