# Disposable Technical Specs and Runways Module

Module is compatible with any latest development build of phpVMS v7 released after **28.APR.2021**. Provides;

* Runway Details (check Support Files folder for a basic dataset)
* ICAO/Subfleet/Aircraft Specifications (Mainly focused on SimBrief and supporting multiple addons for simulators)
* ICAO Type based Maintenance Periods, Pitch and Roll angles (for TO and LANDING), Flap/Gear Speeds definitions
* Basic fuel calculator (mostly useful for GA/Helicopter flights)

## Installation Steps

* Manual Install : Upload contents of the package to your root/modules folder via ftp or your control panel's file manager
* GitHub Clone : Clone/pull repository to your root/modules/DisposableTech folder
* PhpVms Module Installer : Go to admin -> addons/modules , click Add New , select downloaded file and click Add Module

Go to admin section and enable the module, that's all  
After enabling/disabling modules an app cache cleaning process IS necessary (check admin/maintenance)

## Usage

This module does not have any standalone pages. Disposable Theme and some other Disposable Modules are capable of using its functions automatically.

Module provides runway data and technical specs to your flights/simbrief_form.blade, also to your aircraft details page when enabled.  
Both data is pulled from Module Models by helper functions/methods when requested.

As an example, if you need an airport's runways you can get the collection with;

```php
  $runways = Dispo_GetRunways('LTAI') ;
  foreach ($runways as $runway) 
  {
    // Do Whatever You Need Here
  }
```

or inside a blade;

`@php $runways = Dispo_GetRunways($airport->id) ; @endphp`

according to your needs. Also it is possible to utilize the helpers from a controller. For some more examples about their usage you can simply check Disposable addons.

### How can I use Widgets provided ?

Simple, just use standard Laravel call for widgets, currently only one widgets is available called **Fuel Calculator**

```php
@widget('DisposableTech::FuelCalculator')
```  

Fuel Calculator widget has one config option called `icao` which can be used to filter out and use a specific aircraft's icao type code for fuel calculations.

* `['icao' => $aircraft->icao]` (when placed at aircraft details page, uses displayed aircraft's icao type)
* `['icao' => 'B738']` (forced manually to show B738)

When `icao` config option is not used widget will offer a selection dropdown filled with all available ICAO types which have average fuel burn data.

*(In any config, average fuel consumption per hour should be provided via Tech module, widget will not be visible at all without that information)*

## Duplicating Module Blades/Views

Technically all blade files should work with your template but they are mainly designed for Bootstrap compatible themes. So if something looks weird in your template then you need to edit them. I kindly suggest copying them under your theme folder and do your changes there, directly editing module files will only make updating harder for you.

All Disposable Modules are capable of displaying customized files located under your theme folders;

* Original Location : `root/modules/DisposableModule/Resources/Views/somefile.blade.php`
* Target Location   : `root/resources/views/layouts/YourTheme/modules/DisposableModule/somefile.blade.php`

## Update Notes

18.OCT.21
* Performance improvements

11.OCT.21
* Added Average Fuel Burn data to ICAO type based specs
* Added FuelCalculator Widget

28.SEP.21
* Fixed an error related to Weight Checks (caused by module helper)

21.SEP.21
* Technical definitions system updated
* Specifications system updated
* Both systems now support record deletion

11.SEP.21
* PT-BR Translation (Thanks to Edson Felix)
