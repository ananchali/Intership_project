<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->string('domain_name')->nullable();
            $table->string('domain_type')->nullable(); // register, transfer, own
            $table->string('status')->default('pending'); // pending, paid, verified, activated, cancelled
            $table->decimal('total_amount', 10, 2);
            $table->string('currency')->default('ETB');
            $table->json('customer_details')->nullable(); // name, email, phone
            $table->string('payment_method')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
