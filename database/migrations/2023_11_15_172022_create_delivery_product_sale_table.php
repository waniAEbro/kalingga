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
        Schema::create('delivery_product_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId("delivery_product_id")->constrained("delivery_products")->cascadeOnDelete();
            $table->foreignId("sale_id")->constrained("sales")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_product_sale');
    }
};
