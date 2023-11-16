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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('role')->nullable();
            $table->string('user_pic')->nullable();
            $table->string('com_name')->nullable();
            $table->string('com_pic')->nullable();
            $table->string('country')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('reset_pswd_attempt')->nullable();
            $table->string('reset_pswd_time')->nullable();
            $table->string('status')->default('2');
            $table->integer('otp')->nullable();
            $table->unsignedBigInteger('added_user_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('sub_id')->nullable()->default(null);
            $table->date('sub_exp_date')->nullable()->default(null);
            $table->unsignedBigInteger('sub_package_id')->nullable()->default(null);
            $table->unsignedBigInteger('transetional_id')->nullable()->default(null);
            $table->unsignedBigInteger('sadmin_id')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
