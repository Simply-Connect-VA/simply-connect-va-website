<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisposableFlapsTable extends Migration
{
  public function up()
  {
    // Create Disposable Flaps Table
    Schema::create('disposable_flaps', function (Blueprint $table) {
      $table->increments('id');
      $table->string('icao', 5);
      $table->string('f0_name', 10)->nullable()->default('UP');
      $table->string('f0_speed', 4)->nullable();
      $table->string('f1_name', 10)->nullable();
      $table->string('f1_speed', 4)->nullable();
      $table->string('f2_name', 10)->nullable();
      $table->string('f2_speed', 4)->nullable();
      $table->string('f3_name', 10)->nullable();
      $table->string('f3_speed', 4)->nullable();
      $table->string('f4_name', 10)->nullable();
      $table->string('f4_speed', 4)->nullable();
      $table->string('f5_name', 10)->nullable();
      $table->string('f5_speed', 4)->nullable();
      $table->string('f6_name', 10)->nullable();
      $table->string('f6_speed', 4)->nullable();
      $table->string('f7_name', 10)->nullable();
      $table->string('f7_speed', 4)->nullable();
      $table->string('f8_name', 10)->nullable();
      $table->string('f8_speed', 4)->nullable();
      $table->string('f9_name', 10)->nullable();
      $table->string('f9_speed', 4)->nullable();
      $table->string('f10_name', 10)->nullable();
      $table->string('f10_speed', 4)->nullable();
      $table->string('gear_extend', 4)->nullable();
      $table->string('gear_retract', 4)->nullable();
      $table->string('gear_maxtire', 4)->nullable();
      $table->boolean('active')->nullable()->default(true);
      $table->timestamps();
      $table->index('id');
      $table->unique('id');
      $table->unique('icao');
    });
  }

  public function down()
  {
    Schema::dropIfExists('disposable_flaps');
  }
}
