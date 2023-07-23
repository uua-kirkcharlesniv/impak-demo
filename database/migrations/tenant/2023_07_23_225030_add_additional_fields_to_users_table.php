<?php

use App\Enums\Countries;
use App\Enums\EmployeeContractType;
use App\Enums\WorkModel;
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
            $table->string('city')->default('Manila');
            $table->string('country')->default(Countries::PH);
            $table->string('contract_type')->default(EmployeeContractType::FullTime);
            $table->string('work_model')->default(WorkModel::Office);
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
