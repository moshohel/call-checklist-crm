<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRescheduleOrCancelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reschedule_or_cancelations', function (Blueprint $table) {
            $table->id();
            $table->string('client_name')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('reason')->nullable();
            $table->string('previous_session_time')->nullable();
            $table->string('previous_session_date')->nullable();
            $table->string('requested_session_time')->nullable();
            $table->string('requested_session_date')->nullable();
            $table->boolean('reshedule_request')->default(0);
            $table->boolean('cancelation_request')->default(0);
            $table->string('therapist_or_psychiatrist')->nullable();
            $table->string('therapist_or_psychiatrist_user_id')->nullable();
            $table->string('status')->default('NOT DONE');
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
        Schema::dropIfExists('reschedule_or_cancelations');
    }
}
