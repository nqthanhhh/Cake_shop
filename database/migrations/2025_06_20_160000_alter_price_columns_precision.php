<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 15, 2)->change(); // Tăng giới hạn lên 15 chữ số
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('product_price', 15, 2)->change();
            $table->decimal('total_price', 15, 2)->change();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled', 'rejected'])->default('pending')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('price', 10, 2)->change();
        });
        Schema::table('order_items', function (Blueprint $table) {
            $table->decimal('product_price', 10, 2)->change();
            $table->decimal('total_price', 10, 2)->change();
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'confirmed', 'preparing', 'ready', 'delivered', 'cancelled'])->default('pending')->change();
        });
    }
};
