<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // Link deposit to a saving (optional, nullable)
            $table->foreignId('saving_id')->nullable()->constrained('savings')->cascadeOnDelete();

            $table->decimal('amount', 10, 2);
            $table->date('deposited_on');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('deposits', function (Blueprint $table) {
            $table->dropForeign(['saving_id']);
            $table->dropColumn('saving_id');
        });

        Schema::dropIfExists('deposits');
    }
};
