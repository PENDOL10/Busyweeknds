<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTableForAddProductFeature extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Drop old columns if they exist.
            // This is crucial because 'sizes' and 'category_id' replace 'size' and 'category'.
            if (Schema::hasColumn('products', 'category')) {
                $table->dropColumn('category');
            }
            if (Schema::hasColumn('products', 'size')) {
                $table->dropColumn('size');
            }
            // If you had 'stock', 'description', 'price' as different types before,
            // and you're getting 'Column already exists' for them, drop them here as well.
            // Based on previous input, stock and description were text/integer, which might be fine.
            // Price usually is decimal, but if precision changed, dropping/re-adding is safer or use change().

            // Add new columns or ensure they are correctly defined
            // Using 'if (!Schema::hasColumn())' ensures idempotency if migration is run partially.

            // sizes: was string, now JSON
            if (!Schema::hasColumn('products', 'sizes')) {
                $table->json('sizes')->nullable()->after('name');
            }
            // gender: new column
            if (!Schema::hasColumn('products', 'gender')) {
                $table->string('gender')->nullable()->after('sizes');
            }
            // price: ensure correct type if it was modified. If it's already decimal(12,2), no need to add/change
            if (!Schema::hasColumn('products', 'price')) { // Only add if it doesn't exist at all
                $table->decimal('price', 12, 2)->after('gender');
            } else { // If exists, ensure type is correct
                $table->decimal('price', 12, 2)->change();
            }
            // discount: new column
            if (!Schema::hasColumn('products', 'discount')) {
                $table->decimal('discount', 12, 2)->nullable()->after('price');
            }
            // stock: ensure correct type if it was modified.
            if (!Schema::hasColumn('products', 'stock')) { // Only add if it doesn't exist at all
                $table->integer('stock')->default(0)->after('discount');
            } else { // If exists, ensure type is correct
                $table->integer('stock')->default(0)->change();
            }
            // shipping_cost: new column
            if (!Schema::hasColumn('products', 'shipping_cost')) {
                $table->decimal('shipping_cost', 12, 2)->nullable()->after('stock');
            }
            // category_id: replaces 'category'
            if (!Schema::hasColumn('products', 'category_id')) {
                $table->unsignedBigInteger('category_id')->nullable()->after('image');
                // Add foreign key only if the column was just created
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
            }
            
            // Ensure description can be null, if not already
            if (Schema::hasColumn('products', 'description')) {
                $table->text('description')->nullable()->change();
            } else {
                $table->text('description')->nullable()->after('shipping_cost'); // Add if it was completely missing
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
            // Drop foreign key first to avoid errors
            if (Schema::hasColumn('products', 'category_id')) {
                 $table->dropForeign(['category_id']);
            }
           
            // Drop new columns introduced by this migration
            $table->dropColumn([
                'sizes',
                'gender',
                'discount',
                'shipping_cost',
                'category_id', // Drop this after foreign key is dropped
            ]);

            // Revert to old columns if necessary (optional, for full rollback)
            // If you want to revert to the old 'category' string and 'size' string:
            // $table->string('category')->default('T-Shirt')->after('image');
            // $table->string('size')->nullable()->after('category');
            // $table->integer('stock')->default(10)->after('size');
            // $table->text('description')->nullable()->after('stock');
        });
    }
}