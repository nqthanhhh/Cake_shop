<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddShippingStatusToOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Xóa cột `status` nếu tồn tại
            if (Schema::hasColumn('orders', 'status')) {
                $table->dropColumn('status');
            }
        });

        Schema::table('orders', function (Blueprint $table) {
            // Tạo lại cột `status` với kiểu enum
            $table->enum('status', ['pending', 'confirmed', 'shipping', 'completed', 'rejected', 'cancelled'])->default('pending');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->string('delivery_time')->nullable()->after('delivery_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'confirmed', 'completed', 'rejected'])->default('pending')->change();
        });
    }
}
