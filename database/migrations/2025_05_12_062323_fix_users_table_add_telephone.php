<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FixUsersTableAddTelephone extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Jangan tambahkan ulang utype karena sudah ada
            // Hanya pastikan kolom telephone ditambahkan jika belum ada
            if (!Schema::hasColumn('users', 'telephone')) {
                $table->string('telephone')->nullable()->after('email');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'telephone')) {
                $table->dropColumn('telephone');
            }
        });
    }
}