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
        Schema::table(config('survey.database.tables.surveys'), function (Blueprint $table) {
            $table->string('survey_type')->default('post_event');
            $table->string('manual_survey_type')->nullable();
            $table->string('manual_sections')->nullable();
            $table->string('target_focus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('survey', function (Blueprint $table) {
            //
        });
    }
};
