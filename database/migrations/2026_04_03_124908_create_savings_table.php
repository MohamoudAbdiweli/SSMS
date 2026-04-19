<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();

            // Link to users table
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Type of saving
            $table->enum('type', ['regular', 'fixed', 'target'])->default('regular');

            // Optional fields for special savings
            $table->decimal('target_amount', 10, 2)->nullable(); // for target savings
            $table->date('maturity_date')->nullable();           // for fixed savings

            // Status of saving (active/inactive)
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Receipt number (unique, optional if you want to store)
            $table->string('receipt_number')->unique()->nullable();

            // Similar to Loan requested_on
            $table->timestamp('created_on')->useCurrent();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('savings');
    }
};
