<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunityChatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_chat', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->bigInteger('user_id')->unsigned()->nullable();
          $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('set null');
          $table->bigInteger('community_id')->unsigned()->nullable();
          $table->foreign('community_id')
                ->references('id')
                ->on('community')
                ->onDelete('set null');
          $table->string('comment');
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
        Schema::dropIfExists('community_chat');
    }
}
