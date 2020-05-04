<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFriendTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('friend', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('post_user_id')->unsigned()->nullable();
          $table->foreign('post_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
          $table->bigInteger('send_user_id')->unsigned()->nullable();
          $table->foreign('send_user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
          $table->tinyInteger('status')->default(0);
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
        Schema::dropIfExists('friend');
    }
}
