<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSomeFieldsToVicidialUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vicidial_users', function (Blueprint $table) {
            $table->string('designation')->nullable();
            $table->string('gender')->nullable();
            $table->string('age')->nullable();
            $table->string('job_location')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_number_has_whatsapp')->nullable();
            $table->string('e_signature')->nullable();
            $table->string('bmdc_reg_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vicidial_users', function (Blueprint $table) {
            $table->dropColumn('designation');
            $table->dropColumn('gender');
            $table->dropColumn('age');
            $table->dropColumn('job_location');
            $table->dropColumn('contact_number');
            $table->dropColumn('contact_number_has_whatsapp');
            $table->dropColumn('e_signature');
            $table->dropColumn('bmdc_reg_number');
        });
    }
}
