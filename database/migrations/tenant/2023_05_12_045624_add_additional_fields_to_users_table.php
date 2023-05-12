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
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn("name", "first_name");
            $table->string('middle_name')->default('');
            $table->string('last_name')->default('');
            $table->string('gender')->nullable();
            $table->date('date_of_hire')->nullable();
            $table->string('position')->nullable();
            $table->string('nationality')->default('PH');
            $table->string('civil_status')->default('Single');
            $table->string('highest_educational_attainment')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
