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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->nullable();
            $table->float('amountOwed')->nullable();
            $table->float('amountPayed')->nullable();
            $table->string('paymentMethod')->nullable();
            $table->date('lastPayment')->nullable();
            $table->string('cardNumber')->nullable();
            $table->string('bankName')->nullable();
            $table->integer('cardCVV')->nullable();
            $table->string('cardExpDate')->nullable();
            $table->string('cardHolderName')->nullable();
            $table->string('paymentStatus')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
