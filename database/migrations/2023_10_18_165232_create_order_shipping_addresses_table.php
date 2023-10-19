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
        Schema::create('order_shipping_addresses', function (Blueprint $table) {
            $table->foreignId('order_id')->nullable(false);

            $table->string('name')->nullable(false);
            $table->string('postcode')->nullable(false);
            $table->string('city')->nullable(false);
            $table->text('street')->nullable(false);

            $table->foreign('order_id')->references('id')->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_shipping_addresses');
    }
};
