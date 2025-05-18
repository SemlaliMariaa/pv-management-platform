<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFullnameToMeetingUsersTable extends Migration
{
    public function up()
    {
        Schema::table('meeting_users', function (Blueprint $table) {
            $table->string('fullname')->after('user_id');
        });
    }

    public function down()
    {
        Schema::table('meeting_users', function (Blueprint $table) {
            $table->dropColumn('fullname');
        });
    }
}