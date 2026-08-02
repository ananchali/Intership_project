<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable()->after('id')->index();
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->unsignedBigInteger('business_id')->nullable()->after('id')->index();
        });
    }

    public function down(): void
    {
        Schema::table('packages', function (Blueprint $table) {
            $table->dropColumn('business_id');
        });

        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('business_id');
        });
    }
};
