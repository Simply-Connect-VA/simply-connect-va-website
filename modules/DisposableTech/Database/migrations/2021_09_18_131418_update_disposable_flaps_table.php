<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDisposableFlapsTable extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_flaps')) {
      // Add Maximums for pitch, roll and maintenance intervals per icao type
      Schema::table('disposable_flaps', function (Blueprint $table) {
        $table->integer('max_pitch')->nullable()->after('gear_maxtire');
        $table->integer('max_roll')->nullable()->after('max_pitch');
        $table->integer('max_cycle_a')->nullable()->after('max_roll');
        $table->integer('max_time_a')->nullable()->after('max_cycle_a');
        $table->integer('max_cycle_b')->nullable()->after('max_time_a');
        $table->integer('max_time_b')->nullable()->after('max_cycle_b');
        $table->integer('max_cycle_c')->nullable()->after('max_time_b');
        $table->integer('max_time_c')->nullable()->after('max_cycle_c');
      });

      // Rename the table to more respecting name
      Schema::rename('disposable_flaps', 'disposable_tech');
    }

    if (Schema::hasTable('disposable_specs')) {
      // Add main icao type code identifier for specs
      Schema::table('disposable_specs', function (Blueprint $table) {
        $table->string('icao_id', 5)->nullable()->after('id');
      });
    }
  }
}
