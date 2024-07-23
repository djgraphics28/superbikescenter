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
        Schema::create('applications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('customer_id');
            $table->enum('source_of_income',['business','salary','pension']);

            $table->string('name_of_business')->nullable();

            $table->string('company_name')->nullable();
            $table->string('work_position')->nullable();
            $table->integer('years_in_work')->nullable();

            $table->decimal('monthly_income', 16);

            $table->string('comaker_name')->nullable();
            $table->string('comaker_work')->nullable();
            $table->decimal('comaker_monthly_income', 16)->nullable();

            $table->unsignedBigInteger('agent_id')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('cancelled_by')->nullable();
            $table->unsignedBigInteger('denied_by')->nullable();

            $table->date('date_inquired');
            $table->date('date_applied');
            $table->integer('months_to_pay');
            $table->decimal('monthly_payment_amount', 16);
            $table->decimal('loan_amount', 16);
            $table->decimal('downpayment', 16);
            $table->enum('status',['for-review', 'for-ci', 'approved', 'in-progress', 'denied', 'cancelled', 'released'])->default('for-review');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
