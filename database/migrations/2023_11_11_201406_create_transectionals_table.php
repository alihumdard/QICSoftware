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
        Schema::create('transectionals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email');
            $table->string('password');
            $table->string('port');
            $table->string('host');
            $table->string('mail_encryption');
            $table->string('reply_email')->nullable();
            $table->string('cc_email')->nullable();
            $table->string('bcc_email')->nullable();
            $table->string('email_subject')->nullable();
            $table->longText('email_body')->nullable();
            $table->string('status')->default('1');
            $table->string('created_by');
            $table->string('updated_by')->nullable();
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
        Schema::dropIfExists('transectionals');
    }
};
