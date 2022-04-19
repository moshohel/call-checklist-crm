<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddReferralFormColumnsToCallChecklistForShojonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('call_checklist_for_shojon', function (Blueprint $table) {
            $table->dropColumn('financial_affordability');
            $table->string('ref_client_name')->nullable()->after('caller_description');
            $table->unsignedInteger('ref_age')->nullable()->after('ref_client_name');
            $table->text('ref_therapy_reason')->nullable()->after('ref_age');
            $table->string('ref_phone_number')->nullable()->after('ref_therapy_reason');
            $table->string('ref_preferred_time')->nullable()->after('ref_phone_number');
            $table->string('ref_emergency_number')->nullable()->after('ref_preferred_time');
            $table->text('ref_financial_affort')->nullable()->after('ref_emergency_number');
            $table->text('ref_therapist_preference')->nullable()->after('ref_financial_affort');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('call_checklist_for_shojon', function (Blueprint $table) {
            $table->dropColumn('ref_client_name');
            $table->dropColumn('ref_age');
            $table->dropColumn('ref_therapy_reason');
            $table->dropColumn('ref_phone_number');
            $table->dropColumn('ref_preferred_time');
            $table->dropColumn('ref_emergency_number');
            $table->dropColumn('ref_financial_affort');
            $table->dropColumn('ref_therapist_preference');
        });
    }
}
