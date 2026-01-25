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
        Schema::table('orders', function (Blueprint $table) {
            // Tambahkan kolom DP 1, DP 2, DP 3 jika belum ada
            if (!Schema::hasColumn('orders', 'dp_1_amount')) {
                $table->unsignedBigInteger('dp_1_amount')->nullable()->after('total_price')->default(null);
            }
            if (!Schema::hasColumn('orders', 'dp_2_amount')) {
                $table->unsignedBigInteger('dp_2_amount')->nullable()->after('dp_1_amount')->default(null);
            }
            if (!Schema::hasColumn('orders', 'dp_3_amount')) {
                $table->unsignedBigInteger('dp_3_amount')->nullable()->after('dp_2_amount')->default(null);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['dp_1_amount', 'dp_2_amount', 'dp_3_amount']);
        });
    }
};
