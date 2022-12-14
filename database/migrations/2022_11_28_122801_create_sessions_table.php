<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('referr_to')->nullable();
            $table->string('referr_from')->nullable();
            $table->string('name')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('age')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_two')->nullable();
            $table->string('reason_for_therapy')->nullable();
            $table->string('call_data')->nullable();
            $table->string('call_status')->nullable();
            $table->string('session_time')->nullable();
            $table->string('session_date')->nullable();
            $table->string('session_number')->nullable();
            $table->string('communication_medium')->nullable();
            $table->string('appointment_status')->nullable();
            $table->boolean('reshedule_request')->default(0);
            $table->boolean('cancelation_request')->default(0);
            $table->string('referred_therapist_or_psychiatrist')->nullable();
            $table->string('referred_therapist_or_psychiatrist_user_name')->nullable();
            $table->string('referred_therapist_or_psychiatrist_user_id')->nullable();
            $table->string('session_taken')->default('NO');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sessions');
    }
}
