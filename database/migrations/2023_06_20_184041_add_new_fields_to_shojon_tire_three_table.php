<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToShojonTireThreeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shojon_tire_threes', function (Blueprint $table) {
            $table->text('physical_test')->nullable()->default('NO');
            $table->text('message')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shojon_tire_threes', function (Blueprint $table) {
            $table->dropColumn('physical_test');
            $table->dropColumn('message');
        });
    }
}
