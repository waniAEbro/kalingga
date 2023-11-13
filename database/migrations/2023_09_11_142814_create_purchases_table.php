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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId("supplier_id")->constrained("suppliers")->onDelete("cascade");
            $table->date("purchase_date");
            $table->date("due_date");
            $table->text("status");
            $table->float("remain_bill");
            $table->float("total_bill");
            $table->float("paid");
            $table->text("code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
