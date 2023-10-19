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
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("cost");
            $table->double("outer_length");
            $table->double("outer_width");
            $table->double("outer_height");
            $table->double("inner_length");
            $table->double("inner_width");
            $table->double("inner_height");
            $table->double("nw");
            $table->double("gw");
            $table->bigInteger("box_price");
            $table->bigInteger("box_hardware");
            $table->bigInteger("assembling");
            $table->bigInteger("stiker");
            $table->bigInteger("hagtag");
            $table->bigInteger("maintenance");
            $table->bigInteger("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
