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
        Schema::table(config('survey.database.tables.questions'), function (Blueprint $table) {
            $table->smallInteger('sort_order')->default(0)->change();
        });

        Schema::table(config('survey.database.tables.sections'), function (Blueprint $table) {
            $table->smallInteger('sort_order')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
