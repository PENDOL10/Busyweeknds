<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCategoryColumnToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Check if the category column doesn't exist before adding it
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->default('T-Shirt')->after('image');
            }
            
            // Check if we need to add size column too
            if (!Schema::hasColumn('products', 'size')) {
                $table->string('size')->nullable()->after('category');
            }
            
            // Add stock column if it doesn't exist
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(10)->after('size');
            }
            
            // Add description column if it doesn't exist
            if (!Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->after('stock');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            // In down method, we could remove these columns
            // But it's safer to comment these out to prevent accidental data loss
            // $table->dropColumn('category');
            // $table->dropColumn('size');
            // $table->dropColumn('stock');
            // $table->dropColumn('description');
        });
    }
}