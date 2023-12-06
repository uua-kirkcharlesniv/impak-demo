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
        Schema::create('question_quants', function (Blueprint $table) {
            $table->id();
            $table->string('mean')->nullable();
            $table->string('median')->nullable();
            $table->string('mode')->nullable();
            $table->string('zscore')->nullable();
            $table->longText('desc')->nullable();

            $table->unsignedInteger('question_id');
            $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');

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
        Schema::dropIfExists('question_quants');
    }
};
