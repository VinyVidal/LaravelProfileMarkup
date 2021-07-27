<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chat', function (Blueprint $table) {
            $table->increments('id');

            $table->string('message', 500);
            $table->dateTime('received_at')->nullable();
            $table->dateTime('seen_at')->nullable();

            $table->unsignedInteger('sender_id');
            $table->foreign('sender_id')->references('id')->on('users');
            $table->unsignedInteger('receiver_id');
            $table->foreign('receiver_id')->references('id')->on('users');

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
        Schema::dropIfExists('chat');
    }
}
