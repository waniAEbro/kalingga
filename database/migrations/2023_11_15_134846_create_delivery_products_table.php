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
        Schema::create('delivery_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("delivered")->default(0);
            $table->bigInteger("total")->default(0);
            $table->bigInteger("remain")->default(0);
            $table->foreignId("product_id")->constrained("products")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_products');
    }
};
