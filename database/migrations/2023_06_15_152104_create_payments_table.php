<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id')->nullable();
            $table->string('payer_id')->nullable();
            $table->string('payer_email')->nullable();
            $table->float('amount', 10, 2);
            $table->string('currency');
            $table->string('payment_status')->default('attempt');
            $table->integer('package_id');
            $table->string('payment_method');
            $table->text('transaction_error')->nullable();
            $table->text('server_error')->nullable();
            $table->text('payment_token')->nullable();
            $table->string('transaction_status')->default('fail');
            $table->date('exp_date')->default(DB::raw('DATE_ADD(NOW(), INTERVAL 30 DAY)'));
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
