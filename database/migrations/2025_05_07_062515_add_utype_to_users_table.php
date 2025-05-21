<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUtypeToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'utype')) {
                $table->string('utype')->default('USR');
            }
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable()->after('email');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'utype')) {
                $table->dropColumn('utype');
            }
            if (Schema::hasColumn('users', 'telephone')) {
                $table->dropColumn('telephone');
            }
        });
    }
}