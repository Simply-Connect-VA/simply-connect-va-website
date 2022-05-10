<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDisposableTechTable extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_tech')) {
      // Add ICAO based maintenance check durations
      Schema::table('disposable_tech', function (Blueprint $table) {
        $table->decimal('duration_a', $precision = 6, $scale = 2)->nullable()->after('max_time_a');
        $table->decimal('duration_b', $precision = 6, $scale = 2)->nullable()->after('max_time_b');
        $table->decimal('duration_c', $precision = 6, $scale = 2)->nullable()->after('max_time_c');
      });
    }
  }
}
