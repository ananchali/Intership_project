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
        if (!Schema::hasTable('payment_verifications')) {
            Schema::create('payment_verifications', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->foreignId('order_id')->nullable()->constrained()->nullOnDelete();
                $table->string('transaction_number')->nullable();
                $table->text('description')->nullable();
                $table->string('slip_path')->nullable();
                $table->enum('status', ['pending', 'verified', 'rejected'])->default('pending');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_verifications');
    }
};
?>
