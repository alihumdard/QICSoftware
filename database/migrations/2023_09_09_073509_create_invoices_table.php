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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->text('desc')->nullable();
            $table->date('date');
            $table->unsignedBigInteger('sadmin_id');
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('user_id');
            $table->string('client_name');
            $table->string('client_mail');
            $table->unsignedBigInteger('service_id');
            $table->integer('amount');
            $table->string('file')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->string('currency_code')->nullable();
            $table->unsignedBigInteger('location_id')->nullable();
            $table->string('location')->nullable();
            $table->text('comment')->nullable();
            $table->string('send_email')->nullable();
            $table->integer('status')->default(2);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
