<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnUsersTable extends Migration
{

    //本登録用のステータス
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0);
            $table->timestamp('verify_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('verify_at');
        });
    }
}
