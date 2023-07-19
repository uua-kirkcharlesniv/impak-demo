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
        Schema::dropIfExists('survey_respondents');

        Schema::create('survey_respondents', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('survey_id');
            $table->unsignedBigInteger('respondent_id');
            $table->string('type');

            $table->unique(['survey_id', 'respondent_id', 'type']);
            $table->foreign('survey_id')->references('id')->on('surveys')->onDelete('cascade');

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
        Schema::dropIfExists('survey_respondents');
    }
};
