<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apm_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id')->nullable();
            $table->uuid('uuid');
            $table->text('request_body')->nullable();
            $table->text('response_body')->nullable();
            $table->text('headers')->nullable();
            $table->string('url');
            $table->string('method');
            $table->integer('response_time_ms');
            $table->string('ip');
            $table->integer('status_code');
            $table->timestamp('requested_at');

            $table->index('uuid');
            $table->index('url');
            $table->index('status_code');
            $table->index('method');
            $table->index('response_time_ms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apm_requests');
    }
}
