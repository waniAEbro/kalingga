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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string("code");
            $table->string("name");
            $table->string("rfid");
            $table->integer("sell_price");
            $table->double("length");
            $table->double("width");
            $table->double("height");
            $table->integer("production_cost");
            $table->integer("other_cost");
            $table->string("logo");
            $table->integer("barcode");
            $table->foreignId("pack_id")->constrained("packs")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
