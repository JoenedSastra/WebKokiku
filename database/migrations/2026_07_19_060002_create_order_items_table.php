<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('item_type');   // 'menu' (makanan) atau 'drink' (minuman)
            $table->unsignedBigInteger('item_id')->nullable();
            $table->string('item_name');   // snapshot nama, aman walau menu aslinya diubah/dihapus nanti
            $table->unsignedBigInteger('price')->default(0); // snapshot harga saat order dibuat
            $table->unsignedInteger('qty')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};