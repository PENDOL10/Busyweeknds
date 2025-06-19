<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; // Add this line

class UpdateOrderStatuses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('orders')->where('status', 'proses')->update(['status' => 'Processing']);
        DB::table('orders')->where('status', 'selesai')->update(['status' => 'Completed']);
        DB::table('orders')->where('status', 'dibatalkan')->update(['status' => 'Cancelled']);
        // If you had 'menunggu' or similar for 'pending', add it here
        DB::table('orders')->where('status', 'menunggu')->update(['status' => 'Pending']); // Assuming 'menunggu' was old pending
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert back if needed, but typically for status changes,
        // you might not want to revert existing order statuses.
        // Be careful if rolling back in production.
        DB::table('orders')->where('status', 'Processing')->update(['status' => 'proses']);
        DB::table('orders')->where('status', 'Completed')->update(['status' => 'selesai']);
        DB::table('orders')->where('status', 'Cancelled')->update(['status' => 'dibatalkan']);
        DB::table('orders')->where('status', 'Pending')->update(['status' => 'menunggu']); // Revert pending
    }
}