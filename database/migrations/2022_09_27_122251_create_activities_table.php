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
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->integer('admin_id');
            $table->integer('participant1_id')->nullable();
            $table->integer('participant2_id')->nullable();
            $table->integer('participant3_id')->nullable();
            $table->integer('participant4_id')->nullable();
            $table->integer('participant5_id')->nullable();
            $table->integer('participant6_id')->nullable();
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
        Schema::dropIfExists('activities');
    }
};
