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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('global_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->boolean('is_onboarded')->default(false);

            // $table->string('middle_name')->default('');
            // $table->string('gender')->nullable();
            // $table->date('date_of_hire')->nullable();
            // $table->string('position')->nullable();
            // $table->string('nationality')->default('PH');
            // $table->string('civil_status')->default('Single');
            // $table->string('highest_educational_attainment')->nullable();
            // $table->string('phone')->nullable();
            // $table->date('dob')->nullable();
            // $table->boolean('is_employee_onboarded')->default(false);
            // $table->string('city')->default('Manila');
            // $table->string('country')->default(Countries::PH);
            // $table->string('contract_type')->default(EmployeeContractType::FullTime);
            // $table->string('work_model')->default(WorkModel::Office);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
