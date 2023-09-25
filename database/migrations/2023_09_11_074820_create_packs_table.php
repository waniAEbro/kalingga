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
            //$table->integer("cost");
            $table->double("outer_length");
            $table->double("outer_width");
            $table->double("outer_height");
            $table->double("inner_length");
            $table->double("inner_width");
            $table->double("inner_height");
            $table->double("nw");
            $table->double("gw");
            $table->integer("box_price");
            $table->integer("box_hardware");
            $table->integer("assembling");
            $table->integer("stiker");
            $table->integer("hagtag");
            $table->integer("maintenance");
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
