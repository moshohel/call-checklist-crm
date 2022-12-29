<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShojonTireThreesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shojon_tire_threes', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->nullable();
            $table->string('service_providers_name')->nullable();
            $table->string('service_providers_di')->nullable();
            $table->string('date')->nullable();
            $table->string('time_call_started')->nullable();
            $table->string('time_call_ended')->nullable();
            $table->string('duration')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('caller_id')->nullable();
            $table->string('caller_name')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('location')->nullable();
            $table->string('socio_economic')->nullable();
            $table->string('education')->nullable();
            $table->string('marital')->nullable();
            $table->string('session')->nullable();
            $table->string('appearance')->nullable();
            $table->string('behavior')->nullable();
            $table->string('speech')->nullable();
            $table->string('affect')->nullable();
            $table->string('thought')->nullable();
            $table->string('perception')->nullable();
            $table->string('cognition')->nullable();
            $table->string('judgement')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('severity')->nullable();
            $table->string('problem_duration')->nullable();
            $table->text('problem_history')->nullable();
            $table->text('birth_history')->nullable();
            $table->text('family_history')->nullable();
            $table->text('substance_history')->nullable();
            $table->string('suicidal_ideation')->nullable();
            $table->string('self_harm_history')->nullable();
            $table->text('diagnosis')->nullable();
            $table->string('previous_medication')->nullable();
            $table->string('name_of_medicine')->nullable();
            $table->text('concern_history')->nullable();
            $table->text('differential_diagnosis')->nullable();
            $table->string('prescribed_medications')->nullable();
            $table->string('psychotherapy_session_suggested')->nullable();
            $table->text('client_ability_buy_medicine')->nullable();
            $table->string('suitable_session_type')->nullable();



            $table->string('effective')->nullable();
            $table->string('reason_for_referral')->nullable();
            $table->string('name_of_agency')->nullable();
            $table->string('client_referral')->nullable();
            $table->string('session_plan')->nullable();
            $table->text('session_summary')->nullable();
            $table->string('next_session_date')->nullable();
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
        Schema::dropIfExists('shojon_tire_threes');
    }
};
