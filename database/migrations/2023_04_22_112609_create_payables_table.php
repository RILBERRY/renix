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
        Schema::create('payables', function (Blueprint $table) {
            $table->id();
            $table->string('description')->nullable();
            $table->decimal('amount',10,2);
            $table->string('currency');
            $table->string('status');
            $table->string('ref_number')->nullable();
            $table->foreignId('approved_by')->constrained('users')->nullable();
            $table->foreignId('fund_id')->constrained('funds')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payables');
    }
};
