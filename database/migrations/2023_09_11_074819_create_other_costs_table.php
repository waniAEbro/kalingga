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
        Schema::create('other_costs', function (Blueprint $table) {
            $table->id();
            $table->integer("biaya_overhead_pabrik");
            $table->integer("biaya_listrik");
            $table->integer("biaya_pajak");
            $table->integer("biaya_ekspor");
            $table->integer("total");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('other_costs');
    }
};
