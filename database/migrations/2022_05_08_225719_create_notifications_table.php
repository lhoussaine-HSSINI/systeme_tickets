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
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('user_id')->unsigned(); // set relationship in user model
            $table->bigInteger('user_to_notify_id')->unsigned(); //the user who will recive this notification
            $table->string('type'); //follow ,comments etc
            $table->bigInteger('type_id')->unsigned();
            $table->string('data'); //follow id ,comment id etc ,you can set relationship in model about this
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('user_to_notify_id')->references('id')->on('users')->onDelete('cascade');
            $table->boolean('read')->default(0);
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
        Schema::dropIfExists('notifications');
    }
};
