<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sojon_tier2s', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
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
            $table->string('socio-economic')->nullable();
            $table->string('education')->nullable();
            $table->string('marital')->nullable();
            $table->string('session')->nullable();
            $table->string('distress')->nullable();
            $table->string('WHO')->nullable();
            $table->string('symptoms')->nullable();
            $table->string('severity')->nullable();
            $table->string('problem_duration')->nullable();
            $table->text('problem_history')->nullable();
            $table->text('family_history')->nullable();
            $table->string('suicidal_ideation')->nullable();
            $table->string('self_harm_history')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('psychiatric_medication')->nullable();
            $table->string('concern_history')->nullable();
            $table->string('differential_diagnosis')->nullable();
            $table->string('tool_name')->nullable();
            $table->string('score')->nullable();
            $table->text('therapy')->nullable();
            $table->string('predisposing')->nullable();
            $table->string('precipitatory')->nullable();
            $table->string('perpetuating')->nullable();
            $table->string('protective')->nullable();
            $table->string('short_term')->nullable();
            $table->string('long_term')->nullable();
            $table->string('intervention')->nullable();
            $table->string('homework')->nullable();
            $table->string('effective')->nullable();
            $table->string('session_plan')->nullable();
            $table->text('session_summary')->nullable();
            $table->string('session_date')->nullable();
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
        Schema::dropIfExists('sojon_tier2s');
    }
};
