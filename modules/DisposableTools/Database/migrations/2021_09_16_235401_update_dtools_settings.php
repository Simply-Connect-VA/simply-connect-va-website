<?php

use App\Contracts\Migration;
use Illuminate\Support\Facades\DB;

class UpdateDtoolsSettings extends Migration
{
  public function up()
  {
    if (Schema::hasTable('disposable_settings')) {
      // WhazzUp Widget : IVAO
      DB::table('disposable_settings')->updateOrInsert(['key' => 'dtools.whazzup_ivao_fieldname'], ['group' => 'IVAO', 'name' => 'IVAO ID Field Name', 'default' => 'IVAO']);
      DB::table('disposable_settings')->updateOrInsert(['key' => 'dtools.whazzup_ivao_refresh'], ['group' => 'IVAO', 'name' => 'Data Refresh Rate (secs)', 'field_type' => 'numeric', 'default' => '60']);
      // WhazzUp Widget : VATSIM
      DB::table('disposable_settings')->updateOrInsert(['key' => 'dtools.whazzup_vatsim_fieldname'], ['group' => 'VATSIM', 'name' => 'VATSIM CID Field Name', 'default' => 'VATSIM']);
      DB::table('disposable_settings')->updateOrInsert(['key' => 'dtools.whazzup_vatsim_refresh'], ['group' => 'VATSIM', 'name' => 'Data Refresh Rate (secs)', 'field_type' => 'numeric', 'default' => '60']);
    }
  }
}
