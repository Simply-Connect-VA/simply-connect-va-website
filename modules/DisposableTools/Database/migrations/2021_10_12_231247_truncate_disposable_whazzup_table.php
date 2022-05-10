<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;


class TruncateDisposableWhazzupTable extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_whazzup')) {
      // Clean all entries
      DB::table('disposable_whazzup')->truncate();
    }
  }
}
