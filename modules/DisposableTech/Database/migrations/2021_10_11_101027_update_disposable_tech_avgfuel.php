<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDisposableTechAvgfuel extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_tech')) {
      // Add AVG Fuel Consumption field
      Schema::table('disposable_tech', function (Blueprint $table) {
        $table->decimal('avg_fuel', $precision = 8, $scale = 2)->nullable()->after('duration_c');
      });
    }
  }
}
