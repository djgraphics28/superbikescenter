<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // Modify province_id to string
            \DB::statement('ALTER TABLE customers MODIFY province_id VARCHAR(255)');

            // Modify city_id to string
            \DB::statement('ALTER TABLE customers MODIFY city_id VARCHAR(255)');
            // Modify barangay_id to string
            \DB::statement('ALTER TABLE customers MODIFY barangay_id VARCHAR(255)');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            // If you need to rollback, you should define the rollback operations here
            \DB::statement('ALTER TABLE customers MODIFY province_id UNSIGNED BIGINT');
            \DB::statement('ALTER TABLE customers MODIFY city_id UNSIGNED BIGINT');
            \DB::statement('ALTER TABLE customers MODIFY barangay_id UNSIGNED BIGINT');
        });
    }
};
