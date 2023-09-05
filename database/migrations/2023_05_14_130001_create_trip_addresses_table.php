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
        Schema::create('trip_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('desc');
            $table->string('trip_pic');
            $table->string('trip_signature');
            $table->string('trip_note');
            $table->text('driv_trip_pic')->nullable();
            $table->text('driv_trip_signature')->nullable();
            $table->text('driv_trip_note')->nullable();
            $table->text('driv_trip_desc')->nullable();
            $table->text('skiped_address_desc')->nullable();
            $table->integer('trip_id');
            $table->integer('order_no');
            $table->string('status')->default('Invalid');
            $table->integer('address_status')->default(2);
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
        Schema::dropIfExists('trip_addresses');
    }
};
