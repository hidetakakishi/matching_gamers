<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnCommunityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('community', function (Blueprint $table) {
             $table->string('community_comment')->nullable();
             $table->boolean('interface_flag')->default(false);
             $table->boolean('voicechat_flag')->default(false);
             $table->boolean('serve_flag')->default(false);
             $table->boolean('rank_flag')->default(false);
             $table->boolean('level_flag')->default(false);
             $table->boolean('play_time_flag')->default(false);
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('community', function (Blueprint $table) {
             $table->dropColumn('community_comment');
             $table->dropColumn('interface_flag');
             $table->dropColumn('voicechat_flag');
             $table->dropColumn('serve_flag');
             $table->dropColumn('rank_flag');
             $table->dropColumn('level_flag');
             $table->dropColumn('play_time_flag');
         });
     }
}
