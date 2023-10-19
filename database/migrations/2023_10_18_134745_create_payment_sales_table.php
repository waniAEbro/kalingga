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
        Schema::create('payment_sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId("sale_id")->constrained("sales")->onDelete("cascade");
            $table->string('method');
            $table->string("beneficiary_bank");
            $table->string("beneficiary_ac_usd");
            $table->string("bank_address");
            $table->string("swift_code");
            $table->string("beneficiary_name");
            $table->string("beneficiary_address");
            $table->string("phone");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_sales');
    }
};
