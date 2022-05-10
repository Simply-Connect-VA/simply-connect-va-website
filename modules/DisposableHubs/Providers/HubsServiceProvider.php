<?php

namespace Modules\DisposableHubs\Providers;

use App\Services\ModuleService;
use Illuminate\Support\ServiceProvider;
use Route;

class HubsServiceProvider extends ServiceProvider
{
  protected $moduleSvc;

  /** Boot the application events */
  public function boot()
  {
    $this->moduleSvc = app(ModuleService::class);

    $this->registerRoutes();
    $this->registerTranslations();
    $this->registerConfig();
    $this->registerViews();
    $this->registerLinks();

    $this->loadMigrationsFrom(__DIR__.'/../Database/migrations');
  }

  /** Register The Service Provider **/
  public function register() { }

  /** Register Module Links **/
  public function registerLinks()
  {
    /** If You Want To Place The Links Automatically Then Enable below 2 lines **/
    /** DisposableTheme is pre-configure to show below links when you install this module  **/

    // $this->moduleSvc->addFrontendLink('Hubs', '/dhubs', 'fas fa-calendar', $logged_in=true);
    // $this->moduleSvc->addFrontendLink('Stats & Leaderboard', '/dstats', 'fas fa-cog', $logged_in=true);

    /** Do Not Remove Admin Link **/
    $this->moduleSvc->addAdminLink('Statistics Manager', '/admin/disposablehubs');
  }

  /** Register Routes **/
  protected function registerRoutes()
  {
    /** Frontend Routes **/
    Route::group([
        'as'     => 'DisposableHubs.',
        'prefix' => '',
        'middleware' => ['web'],
        'namespace'  => 'Modules\DisposableHubs\Http\Controllers',
    ], function () {
      Route::group([
        'middleware' => ['auth'],
      ], function () {
        // Stats Contoller Routes
        Route::get('stats', 'StatsController@stats')->name('dstats');
        // Hubs Controller Routes
        Route::get('hubs', 'HubsController@hubs')->name('hindex');
        Route::get('hubs/{id}', 'HubsController@show')->name('hshow');
      });
    });

    /** Admin Routes **/
    Route::group([
        'as'     => 'DisposableHubs.',
        'prefix' => 'admin',
        'middleware' => ['web', 'role:admin'],
        'namespace'  => 'Modules\DisposableHubs\Http\Controllers',
    ], function () {
      Route::group([],
        function () {
        Route::get('disposablehubs', 'AdminController@admin')->name('dhubsadmin');
        });
    });
  }

  protected function registerConfig()
  {
    $this->publishes([ __DIR__.'/../Config/config.php' => config_path('DisposableHubs.php'),], 'config');
    $this->mergeConfigFrom( __DIR__.'/../Config/config.php', 'DisposableHubs');
  }

  public function registerTranslations()
  {
    $langPath = resource_path('lang/modules/DisposableHubs');

    if (is_dir($langPath)) {
      $this->loadTranslationsFrom($langPath, 'DisposableHubs');
    } else {
      $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'DisposableHubs');
    }
  }

  public function registerViews()
  {
    $viewPath = resource_path('views/modules/DisposableHubs');
    $sourcePath = __DIR__.'/../Resources/views';

    $this->publishes([$sourcePath => $viewPath,], 'views');

    $this->loadViewsFrom(array_merge(array_map(function ($path) {
      return $path . '/modules/DisposableHubs';
    }, \Config::get('view.paths')), [$sourcePath]), 'DisposableHubs');
  }

  public function provides(): array { return []; }
}
