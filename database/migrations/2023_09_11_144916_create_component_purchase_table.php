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
        Schema::create('component_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId("component_id")->constrained("components")->onDelete("cascade");
            $table->foreignId("purchase_id")->constrained("purchases")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_purchases');
    }
};
