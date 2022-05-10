<?php

use App\Contracts\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDtoolsSettingsTable extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_settings') && !Schema::hasColumn('disposable_settings', 'field_type')) {
      // Update Disposable Settings Table
      Schema::table('disposable_settings', function (Blueprint $table) {
        $table->string('default', 250)->nullable()->after('value');
        $table->string('field_type', 50)->nullable()->after('group');
        $table->text('options')->nullable()->after('field_type');
        $table->string('desc', 250)->nullable()->after('options');
        $table->string('order', 6)->nullable()->after('desc');
      });
    }
  }
}
