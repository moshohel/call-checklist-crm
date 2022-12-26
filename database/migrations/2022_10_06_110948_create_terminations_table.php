<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTerminationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('terminations', function (Blueprint $table) {
            $table->id();
            $table->string('project_name')->nullable();
            $table->string('counselor_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('client_id')->nullable();
            $table->string('date')->nullable();
            $table->string('main_reason')->nullable();
            $table->string('who_terminated')->nullable();
            $table->string('referred_date')->nullable();
            $table->string('first_contact')->nullable();
            $table->string('last_session')->nullable();
            $table->string('total_session')->nullable();
            $table->string('scheduled')->nullable();
            $table->string('attended')->nullable();
            $table->string('cancelled')->nullable();
            $table->string('not_attend')->nullable();
            $table->string('distress_pre')->nullable();
            $table->string('distress_post')->nullable();
            $table->string('wellbeing_pre')->nullable();
            $table->string('wellbeing_post')->nullable();
            $table->string('psychological_pre')->nullable();
            $table->string('psychological_post')->nullable();
            $table->text('feedback')->nullable();
            $table->text('learning')->nullable();
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
        Schema::dropIfExists('terminations');
    }
};
