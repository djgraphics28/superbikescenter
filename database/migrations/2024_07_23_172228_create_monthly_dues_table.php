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
        Schema::create('monthly_dues', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('application_id');
            $table->date('due_date');
            $table->decimal('monthly_payment', 16)->nullable();
            $table->decimal('penalty_amount', 16)->nullable();
            $table->enum('status',['unpaid','paid'])->default('unpaid');
            $table->string('receipt_number')->nullable();
            $table->string('payment_method')->nullable();
            $table->decimal('amount_paid', 16)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('monthly_dues');
    }
};
