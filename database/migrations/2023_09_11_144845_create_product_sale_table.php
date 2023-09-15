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
        Schema::create('product_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId("product_id")->constrained("products")->onDelete("cascade");
            $table->foreignId("sale_id")->constrained("sales")->onDelete("cascade");
            $table->integer("quantity");
            $table->integer("packing_cost");
            $table->integer("outer_length");
            $table->integer("outer_width");
            $table->integer("outer_height");
            $table->integer("inner_length");
            $table->integer("inner_width");
            $table->integer("inner_height");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
