<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Tambahkan kolom user_id di sini
            // Pastikan tabel 'users' sudah ada dan memiliki kolom 'id'
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Menggunakan 'users' sebagai referensi tabel

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('address')->nullable();
            $table->string('apartment');
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('postal_code');
            $table->string('phone')->nullable();
            $table->string('payment_proof')->nullable();
            $table->decimal('shipping_cost', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}