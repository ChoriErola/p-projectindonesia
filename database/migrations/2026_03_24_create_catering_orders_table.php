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
        Schema::create('catering_orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique();
            $table->string('nama_acara', 50);
            $table->string('nama_pelanggan', 50);
            $table->string('code_pelanggan')->nullable();
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->integer('qty');
            $table->decimal('harga_per_porsi', 12, 2)->default(25000);
            $table->decimal('total_harga', 15, 2);
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catering_orders');
    }
};
