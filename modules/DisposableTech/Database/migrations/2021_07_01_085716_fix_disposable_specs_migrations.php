<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Check previous migrations and apply them if necessary
class FixDisposableSpecsMigrations extends Migration
{
  public function up()
  {
    // Check First Update
    if (!Schema::hasColumn('disposable_specs', 'icao')) {

      // Add Aircraft ICAO, Name, Engines and Cruise Level Offset columns
      Schema::table('disposable_specs', function (Blueprint $table) {
        $table->string('icao', 5)->nullable()->after('stitle');
        $table->string('name', 20)->nullable()->after('icao');
        $table->string('engines', 20)->nullable()->after('name');
        $table->string('cruiselevel', 6)->nullable()->after('fuelfactor');
      });

    }

    // Check Second Update
    if (!Schema::hasColumn('disposable_specs', 'paxwgt')) {

      // Add Passenger and Baggage Weight columns
      Schema::table('disposable_specs', function (Blueprint $table) {
        $table->string('paxwgt', 3)->nullable()->after('cruiselevel');
        $table->string('bagwgt', 3)->nullable()->after('paxwgt');
      });

    }
  }
}
