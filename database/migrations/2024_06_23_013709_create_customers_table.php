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
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('sufix_name')->nullable();
            $table->string('username');
            $table->string('email');
            $table->string('password');
            $table->string('contact_number');
            $table->date('birth_date');
            $table->enum('gender',['Male','Female']);
            $table->enum('marital_status',['Single','Married', 'Widowed']);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('province_id');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('barangay_id');
            $table->text('address1');
            $table->text('address2')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
