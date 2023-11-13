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
            $table->string("code")->unique();
            $table->text("name");
            $table->string("rfid")->unique();
            $table->bigInteger("sell_price");
            $table->bigInteger("sell_price_usd");
            $table->double("length");
            $table->double("width");
            $table->double("height");
            $table->text("logo");
            $table->text("barcode");
            $table->bigInteger("hpp");
            $table->foreignId("pack_id")->constrained("packs")->onDelete("cascade");
            $table->foreignId("productioncosts_id")->constrained("production_costs")->onDelete("cascade");
            $table->foreignId("othercosts_id")->constrained("other_costs")->onDelete("cascade");
            $table->bigInteger("cbm");
            $table->string('image')->nullable();
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
