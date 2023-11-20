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
        Schema::create('delivery_component_purchase', function (Blueprint $table) {
            $table->id();
            $table->foreignId("delivery_component_id")->constrained("delivery_components")->cascadeOnDelete();
            $table->foreignId("purchase_id")->constrained("purchases")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_component_purchase');
    }
};
