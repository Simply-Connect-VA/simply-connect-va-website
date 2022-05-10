# Disposable Hubs Module

Module is compatible with any latest development build of phpVMS v7 released after **12.APR.2021**. Provides;

* Hubs page
* Hub Details page
* Statistics page with overall phpvms v7 stats and some leaderboards

## Installation Steps

* Manual Install : Upload contents of the package to your root/modules folder via ftp or your control panel's file manager 
* GitHub Clone : Clone/pull repository to your root/modules/DisposableHubs folder
* PhpVms Module Installer : Go to `admin -> addons/modules` , click `Add New` , select downloaded file and click `Add Module`

Go to admin section and enable the module, that's all (only needed for Manual Install and Github Clone)
After enabling/disabling modules an app cache cleaning process IS necessary (check admin/maintenance)

## Usage

If you want to enable module auto links, then enable frontend link registration commands in ModuleFolder\Providers\....ServiceProvider.php file as shown below, *Two forward slashes (//) = Disabled, No forward slashes = Enabled*

```php
    $this->moduleSvc->addFrontendLink('Hubs', '/dhubs', 'fas fa-calendar', $logged_in=true);
    // $this->moduleSvc->addFrontendLink('Stats & Leaderboard', '/dstats', 'fas fa-cog', $logged_in=true);
```

Disposable Theme v2 IS capable of recognizing and showing proper links for Disposable Modules but if you need some more control, then you can add links to your navbar (or any other place) with below examples;

```html
<li>
  <a class="nav-link" href="{{ route('DisposableHubs.hindex') }}">
    <i class="fas fa-paper-plane"></i>
    <span>Hubs</span>
  </a>
</li>

<li>
  <a class="nav-link" href="{{ route('DisposableHubs.dstats') }}">
    <i class="fas fa-calendar-alt"></i>
    <span>Statistics & LeaderBoards</span>
  </a>
</li>
```

Also having a direct link to a specific hub is possible with

```html
<li>
  <a class="nav-link" href="{{ route('DisposableHubs.hshow', ['LTFM']) }}">
    <i class="fas fa-calendar-day"></i>
   <span>LTFM Hub</span>
  </a>
</li>
```

*(Best way to add links in Laravel structure is to use routes like above, but plain html `href="/dhubs/LTFM"` is also possible)*

## Duplicating Module Blades/Views

Technically all blade files should work with your template but they are mainly designed for Bootstrap compatible themes. So if something looks weird in your template then you need to edit them. I kindly suggest copying them under your theme folder and do your changes there, directly editing module files will only make updating harder for you.

All Disposable Modules are capable of displaying customized files located under your theme folders;

* Original Location : `root/modules/DisposableModule/Resources/Views/somefile.blade.php`
* Target Location   : `root/resources/views/layouts/YourTheme/modules/DisposableModule/somefile.blade.php`

## Update Notes

18.OCT.21
* Performance optimizations

24.SEP.21
* ES Translation (Thansk to Maco)

11.SEP.21
* PT-BR Translation (Thanks to Edson Felix)

07.AUG.21
* Added failsafe for country lookup (ISO codes vs full names)
* Release zip file structure changed for PhpVms Module Installer compatability.

08.JUL.21
* IT Translation (thanks @Fabietto996)

06.JUL.21
* Updated DE Translation (thanks @GAE074)

03.JUN.21
* DE Translation (thanks @derrobin154)

12.MAY.21
* Added example placement for Flights Map to Hub Details page (Needs updated DisposableTools Module)
