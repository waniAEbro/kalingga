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
        Schema::create('sale_productions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sale_id")->constrained("sales")->onDelete("cascade");
            $table->foreignId("production_id")->constrained("productions")->onDelete("cascade");
            $table->bigInteger("quantity_finished");
            $table->bigInteger("quantity_not_finished");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_productions');
    }
};
