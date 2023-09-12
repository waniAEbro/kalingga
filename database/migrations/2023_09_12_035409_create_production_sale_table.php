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
        Schema::create('production_sale', function (Blueprint $table) {
            $table->id();
            $table->foreignId("production_id")->constrained("productions")->onDelete("cascade");
            $table->foreignId("sale_id")->constrained("sales")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_sales');
    }
};
