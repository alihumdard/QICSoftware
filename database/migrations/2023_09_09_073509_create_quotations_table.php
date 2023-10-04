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
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->text('desc')->nullable();
            $table->date('date');
            $table->integer('admin_id');
            $table->integer('user_id');
            $table->string('client_name');
            $table->text('service_data');
            $table->integer('amount');
            $table->string('file')->nullable();
            $table->string('currency_id')->nullable();
            $table->string('currency_code')->nullable();
            $table->string('location_id')->nullable();
            $table->string('location')->nullable();
            $table->integer('status')->default(2);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('quotations');
    }
};
