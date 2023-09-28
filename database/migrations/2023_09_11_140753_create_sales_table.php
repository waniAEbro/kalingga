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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId("customer_id")->constrained("customers")->onDelete("cascade");
            $table->date("sale_date");
            $table->date("due_date");
            $table->string("status");
            $table->integer("remain_bill");
            $table->integer("total_bill");
            $table->integer("paid");
            $table->string("code");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};