<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReassignRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reassign_requests', function (Blueprint $table) {
            $table->id();
            $table->string('session_id')->nullable();
            $table->string('date')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('phone_number')->nullable();
            $table->text('reason_for_reassing')->nullable();
            $table->string('status')->default('NO');
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
        Schema::dropIfExists('reassign_requests');
    }
}
