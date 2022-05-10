# Disposable Widgets and Tools Module

Module provides some widgets and handy tools for phpVMS v7.

## Installation Steps

* Manual Install : Upload contents of the package to your root/modules folder via ftp or your control panel's file manager
* GitHub Clone : Clone/pull repository to your root/modules/DisposableTools folder
* PhpVms Module Installer : Go to admin -> addons/modules , click Add New , select downloaded file and click Add Module

Go to admin section and enable the module, that's all  
After enabling/disabling modules an app cache cleaning process IS necessary (check admin/maintenance)

## Usage

Call the widgets anywhere you want like you call/load others

```php
@widget('DisposableTools::ActiveBookings')
@widget('DisposableTools::ActiveUsers')
@widget('DisposableTools::AircraftLists', ['type' => 'location'])
@widget('DisposableTools::AircraftStats', ['id' => $aircraft->id])
@widget('DisposableTools::AirlineStats')
@widget('DisposableTools::AirportAircrafts', ['location' => $airport->id])
@widget('DisposableTools::AirportInfo')
@widget('DisposableTools::AirportPireps', ['location' => $airport->id])
@widget('DisposableTools::Discord', ['server' => 1234567890123456789])
@widget('DisposableTools::FlightBoard')
@widget('DisposableTools::FlightsMap', ['source' => $hub->id])
@widget('DisposableTools::FlightTimeMultiplier')
@widget('DisposableTools::PersonalStats', ['disp' => 'full', 'user' => $user->id])
@widget('DisposableTools::RandomFlight')
@widget('DisposableTools::SunriseSunset', ['location' => $airport->id])
@widget('DisposableTools::TopAirlines', ['count' => 3, 'type' => 'flights'])
@widget('DisposableTools::TopAirports', ['count' => 5, 'type' => 'dep'])
@widget('DisposableTools::TopPilots', ['type' => 'landingrate'])
@widget('DisposableTools::WhazzUpIVAO')
@widget('DisposableTools::WhazzUpVATSIM')
```

Also if you wish, it is always possible to use widgets with full paths like below.  

` @widget('Modules\DisposableTools\Widgets\ActiveBookings') `

### Active Bookings

` @widget('DisposableTools::ActiveBookings') `  
Displays active SimBrief briefing packs with flight, aircraft and user details. No config options

By design widget will refresh its data every 60 seconds automatically when visible/loaded.

### Active Users

` @widget('DisposableTools::ActiveUsers') `  
Displays current active user sessions, needs the session to be handled by database

* `['mins' => 3]` Sets timer to 3 mins (default is 5 mins)

By design widget will refresh its data every 60 seconds automatically when visible/loaded.

### Aircraft Lists

` @widget('DisposableTools::AircraftLists') `  
Displays either your aircraft count according to their locations or a count according the their ICAO type codes.  
Also is capable of displaying non-hub airports only  

* `['type' => 'icao']`
* `['type' => 'location']`
* `['type' => 'nohubs']`

Default option is `location`  

### Aircraft Stats

` @widget('DisposableTools::AircraftStats', ['id' => $aircraft->id]) `  
Displays aircraft (registration) based stats. Needs an aircraft id to work  

* `['id' => $aircraft->id]`

### Airline Stats

` @widget('DisposableTools::AirlineStats') `  
Displays overall system stats or stats for the airline provided.

* `['airline' => 3]`
* `['airline' => $user->airline->id ]`
* `['airline' => $flight->airline->id ]`  

### Airport Aircrafts

` @widget('DisposableTools::AirportAircrafts', ['location' => $airport->id]) `  
Displays your aircraft at given location. Location *must* be an airport_id (4 letter ICAO code)  

* `['location' => 'LTCG']`
* `['location' => $airport->icao]`
* `['location' => $flight->dpt_airport_id]`

### Airport Info

` @widget('DisposableTools::AirportInfo') `  
Displays your airports in a dropdown and offers a button to visit Airport/Hub details page.  
Can be configured to display `all` or `nohubs` or `hubs`

* `['type' => 'all']`
* `['type' => 'nohubs']`
* `['type' => 'hubs']`

Default option is `all`  
*(This widget is developed by Maco and being used in this module by his permission.)*  

### Airport Pireps

` @widget('DisposableTools::AirportPireps', ['location' => $airport->id]) `  
Displays pireps for given location. Location *must* be an airport_id (4 letter ICAO code)  

* `['location' => 'LTAI']`
* `['location' => $airport->icao]`
* `['location' => $flight->dpt_airport_id]`

### Discord

` @widget('DisposableTools::Discord', ['server' => 1234567890123456789]) `  
Displays your Discord server data, server id MUST be provided. Check your Discord Server settings for details.  
Can be configured to hide/display *Discord Bots*

* `['server' => 1234567890]` Your Discord Server ID, mandatory
* `['bots' => true]` (optional) will show *Discord Bots* as online users (default is false)
* `['bot' => ' My Bot']` (optional) will remove members which have ' My Bot' in their username from your list (default is ' Bot')

By design widget will refresh its data every 60 seconds automatically when loaded.

### Flight Board

` @widget('DisposableTools::FlightBoard') `  
Displays active flights only, has no settings and/or configuration options.

By design widget will refresh its data every 60 seconds automatically when visible/loaded.

### Flights Map

` @widget('DisposableTools::FlightsMap', ['source' => $hub->id]) `  
Shows a Leaflet map of your flights, user pireps or fleet locations. With configuration options results can be limited to an airline, an airport etc.  
Leatlet map itself can be configured/re-styled via duplicated widget blade file if needed.  

Has 3 main options, these are `source`, `visible` and `limit`. And one conditional option called `airline` which is used to get an airline's fleet.
Visible and limit should be used in custom cases, provided defaults for them are ok for generic usage.  

if used `source` *can* be an **airport_id** (4 letter ICAO code), an **airline_id** or **user** (not user_id, plain text *user*) or **fleet**.  
if used `visible` *must* be either false or true (it show visible flights or hides them - default is true like phpvms and only visible flights are used)  
if used `limit` *must* be a numeric value like **50**, which will limit the flights being drawn on the map. Default is *null* so all flights are drawn.  
when `'source' => 'fleet'` is used then you can use the `'airline' => $airline_id` (or `'airline' => 3` etc) to filter the results to that airline only.  

* `['source' => $airport->id]` *(Will display ALL in/out flights of that Airport)*
* `['source' => $airline->id, 'limit' => 200]` *(Will display 200 flights of that Airline)*
* `['source' => 'user', 'limit' => 100]` *(Will display last 100 pireps for the user)*
* `['source' => 'fleet']` *( All Fleet Members Shown on the map)*
* `['source' => 'fleet', 'airline' => $airline->id ]` *(Only selected Airline's fleet will be displayed)*

To use the widget at phpvms Flights (list/search) page, there is no need to define a source, just call the widget directly (maybe with some limits).  
Widget will follow your admin side settings to filter results (like pilots only see their airline's flights or flight's from their current location)  

### Flight Time Multiplier

` @widget('DisposableTools::FlightTimeMultiplier') `  
This is just a javascript calculator. Enter hours, minutes and the multiplier to get the result.  
Some VA's or platforms offer double or multiplied hours for some tours and events, thus this may come in handy.  

### Personal Stats

` @widget('DisposableTools::PersonalStats', ['disp' => 'full', 'user' => $user->id]) `  
There are four main options which are `user`, `disp`, `type` and `period`;

`user` can be any user's id or not used at all  
`period` can be any **number of days** (except 0 of course), **currentm**, **lastm**, **prevm**, **currenty**, **lasty**, **q1**, **q2**, **q3**, **q4** or not used at all  
`disp` can be full or not used at all  
`type` can be **avglanding**, **avgscore**, **avgtime**, **tottime**, **avgdistance**, **totdistance**, **avgfuel**, **totfuel** or **totflight**

If no user is defined, widget get current user's data for calculations. This may be used for dashboard or any personal pages where the viewer will be able to see his results.  
If you want to put some stats on the user's profile page then you need to define the user otherwise every visitor will see their stats :) `['user' => $user->id]` is enough to get proper results at user profile page.  

If no period is defined then all accepted reports will be used for calculations, `['period' => 7]` will consider the pireps of last 7 days for selected type

If you want to have a full card with the result and the info text then use `['disp' => 'full']` while calling the widget. It should be compatible with the default template and any bootstrap compatible one but if you need you can customize the by duplicating *personalstats.blade*.  

Some combined examples are below;  

* `['disp' => 'full', 'user' => $user->id, 'type' => 'totfuel', 'period' => 'lastm']` Total Fuel Spent During Last Month displayed in a card
* `['disp' => 'full', 'user' => $user->id, 'type' => 'avglanding']` Overall Average Landing Rate displayed in a card
* `['user' => $user->id, 'type' => 'totdistance', 'period' => 7]` Plain text total distance in last 7 days
* `['user' => $user->id, 'type' => 'totflight', 'period' => 3]` Plain text number of flights in last 3 days

Note for "Quarter (q)" periods;

* q1 (Quarter 1) JAN-FEB-MAR
* q2 (Quarter 2) APR-MAY-JUN
* q3 (Quarter 3) JUL-AUG-SEP
* q4 (Quarter 4) OCT-NOV-DEC

### Random Flights

` @widget('DisposableTools::RandomFlight') `  
Picks up some random flights for your pilots according to phpVMS settings (Aircraft and Company restrictions) and widget configuration.  

* `['count' => 3]` The amount of flights to be picked (default is 1)
* `['daily' => true]` Will force the widget to pick random flight once per day (can be true or false, default is false)
* `['hub' => true]` Will force the widget to pick up random flights departing from user's own hub/home airport (can be true or false, default is false)

For example; Imagine setting and *daily* and *hub* to **false**, then the widget will pick up a new flight for each airport user visits.  
You will get a random flight when you start the day, from A to B. When you finish that flight with an accepted pirep, your location will change and widget will pick another flight for you from B to C (or maybe from B to A or B to D).

Provided Pirep check is for visual reference only, it will not change widget's operation logic. So a user can choose not to fly offered one and use JumpSeat or pick another flight, widget will continue offering new random flights after each location change. (if daily is set to false)

` @widget('DisposableTools::RandomFlight', ['count' => 5, 'daily' => true]) `  
This example will give users 5 random flights, departing from their current location, only once for that day. There will be no changes until the end of the day.

In any config, random flights will be refreshed each day.

### Sunrise Sunset

` @widget('DisposableTools::SunriseSunset', ['location' => $airport->id]) `  
Displays sunrise/sunset times of given location. Location *must* be an airport_id (4 letter ICAO code)

* `['location' => 'LTAI']`
* `['location' => $airport->id]`
* `['location' => $flight->dpt_airport_id]`

### Top Airlines

` @widget('DisposableTools::TopAirlines', ['count' => 3, 'type' => 'flights']) `  
Displays an "airline" leaderboard according to **flights**, **flight time** or **distance flown**  
There are three main options.They are `count`, `type` and `period`;

`count` can be **any number** you want (except 0 of course)  
`type` can be **flights**, **time**, **distance**, **landingrate**, **score**  
`period` can be **currentm**, **lastm**, **prevm**, **currenty**, **lasty**, **prevy**

* `['count' => 5, 'type' => 'flights']`
* `['count' => 10, 'type' => 'time']`
* `['count' => 8, 'type' => 'distance']`

Default options will give you overall top 3 airlines by their flight counts. If you want to see your "Best" airline, just set count to 1

### Top Airports

` @widget('DisposableTools::TopAirports', ['count' => 5, 'type' => 'dep']) `  
Displays your most used airports according to their **take off** or **landing** counts.
Options are `count` and `type`;

`count` can be **any number** you want (except 0 of course)  
`type` can be **dep** or **arr**

* `['count' => 8, 'type' => 'dep']`
* `['count' => 5, 'type' => 'arr']`

Default options will give you top 3 airports by their take off counts

### Top Pilots

` @widget('DisposableTools::TopPilots', ['type' => 'landingrate']) `  
Displays a "pilot" leaderboard according to **flights**, **flight time**, **distance flown** or **average landing rate**  
Widget has four main options called `count`, `type`, `period` and `hub`;

`count` can be **any number** you want (except 0 of course)  
`type` can be **flights**, **time**, **distance**, **landingrate**, **score**  
`period` can be **currentm**, **lastm**, **prevm**, **currenty**, **lasty**, **prevy**  
`hub` can be any **airport id** (4 letter icao identifier), prefably one of your hubs  

* `['count' => 5, 'type' => 'flights']`
* `['count' => 10, 'type' => 'time']`
* `['count' => 8, 'type' => 'distance']`
* `['count' => 1, 'type' => 'landingrate']`
* `['count' => 1, 'type' => 'landingrate', 'hub' => 'LTAI']`
* `['count' => 1, 'type' => 'landingrate', 'hub' => $hub->id]`

Default options will give you the overall top 3 pilots by their flight counts. If you want to see your "Best" pilot, just set count to 1  

### WhazzUp Widgets (IVAO & VATSIM)

` @widget('DisposableTools::WhazzUpIVAO') ` or ` @widget('DisposableTools::WhazzUpVATSIM') `  
There are no widget driven settings for these two, their settings are at Admin -> DisposableTools page.

Data refresh interval is set to 60 seconds by default, both networks require a minimum of 15 seconds so if you want to lower the defaults, anything below 15 seconds will not work. To reduce traffic on your server, I kindly suggest setting refresh interval to something like 180 seconds (3 mins) or 300 seconds (5 mins).

If you defined your custom user profile field names for IVAO/VATSIM something like IVAO_ID or VATSIM-CID etc then you need to use the exact same name in widget settings too. **Failing this step will result 'No .... Online Flights Found' result even if you have pilots flying online.**

Widget does not store any past records or historic data, so what you will get is the latest whazzup data IVAO/VATSIM servers have at that moment.

Only for the first run, you may see *'No Valid Data Found'* result, just wait or refresh the page.  
By design widget will refresh its data every 60 seconds automatically when visible/loaded.

## Duplicating Module Blades/Views

Technically all blade files should work with your template but they are mainly designed for Bootstrap compatible themes. So if something looks weird in your template then you need to edit them. I kindly suggest copying them under your theme folder and do your changes there, directly editing module files will only make updating harder for you.

All Disposable Modules are capable of displaying customized files located under your theme folders;

* Original Location : `root/modules/DisposableModule/Resources/Views/somefile.blade.php`
* Target Location   : `root/resources/views/layouts/YourTheme/modules/DisposableModule/somefile.blade.php`

## Update Notes

19.OCT.21
* Fixed a date bug effecting Personal Stats, Top Pilots and Top Airlines widgets
* Added `score` as another config option for Top Pilots and Top Airlines widgets
* Refactored codes of mentioned widgets and their blades

18.OCT.21
* Widget and Helpers performance optimizations

13.OCT.21
* Added missing `Dispo_TimeConvert()` to module helpers.

12.OCT.21
* Reduced amount of data stored with WhazzUp Widgets to improve database operations  
*(If you need anything else other than online pilot data like servers or observers etc, just un-comment the lines you need)*

5.OCT.21
* IVAO/VATSIM WhazzUp Widget code update (nothing visible, just logging server error response and keeping our logs clean)

29.SEP.21
* Another fix for Flights Map Widget (Hub names had a little problem, thanks to Sir Doug for pointing it out)

27.SEP.21

* Fixed Flights Map Widget (links to flights/pireps was not working)
* Improved module helpers

23.SEP.21

* Improved the Flights Map Widget, moved all logical operations to controller
* Added a new option to Flights Map Widget (Displaying an Airline's fleet when needed)
* Overall code cleanup and some refactoring of widget controllers

17.SEP.21

* Updated Module helpers
* Updated Widget settings backend

11.SEP.21

* PT-BR Translation (Thanks to Edson Felix)

10.SEP.21

* Fixed FlightBoard Widget (again)
* Fixed AirportInfo Widget (php8 compatibility)

07.SEP.21

* Fixed RandomFlights Widget's pirep checks.
* Improved the random flight picker (now it checks already flown flights and tries to offer something new)

06.SEP.21

* Fixed FlightBoard Widget
* Added Discord Widget
* Added RandomFlights Widget

01.SEP.21

* Added FlightBoard widget to display active flights (without a map)
* Added link to DispoDbCheck to module's admin section page

28.AUG.21

* Added a new simple database check page for error identification ( visit `yourphpvms.com/admin/dispodbcheck` )
* Added another failsafe to WhazzUp Widget (thanks @dougjuk for his patience during the process)

22.AUG.21

* Updated AirportInfo widget, it is now able to use some config options

17.AUG.21

* FlightsMap widget is now capable of displaying fleet member locations.
* A little bugfix / safety measure applied to AircraftLists widget

15.AUG.21

* Improved AircraftLists widget with a new config option and code cleanup
* Improved AirportAircraft widget to use DisposableAirlines routes if it is installed

08.AUG.21

* Another fix for SunriseSunset Widget (still uses core php methods to get times)

07.AUG.21

* Code cleanup on some widgets and some improvements
* Version rounding

24.JUL.21

* Added IVAO and VATSIM WhazzUp Widgets
* Improved Top Pilots widget to filter results for a Hub when needed
* Refactored some helpers

08.JUL.21

* IT Translation (thanks @Fabietto996)

06.JUL.21

* Improved helpers to match vmsAcars updates (Flaps & Speeds being reported)

01.JUL.21

* Added new widget to show active aircraft + flight bookings (via SimBrief Planning)
* Improved DE Translation (thanks @GAE074)

18.JUN.21

* FlightMap Widget will show user's flown city pairs with a different color.

10.JUN.21

* Update helpers to show SimBrief Booking state as AC state too.

03.JUN.21

* Failsafe for $user (thanks @derrobin154)
* DE Translation (thanks @derrobin154)

29.MAY.21

* Removed deprecated `Dispo_FlightTypes` function from module helpers

13.MAY.21

* Added a failsafe to FlightsMap (during initial setup of phpvms, admin has no home or current airport)

12.MAY.21

* Fixed FlightMaps Widget controller (pilot company restriction filter)

11.MAY.21

* Added two new widgets
* Added Days decoding function
* Fixed some minor errors in current widgets
