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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('purchase_id')->constrained('purchases')->nullable();
            $table->foreignId('item_id')->constrained('items')->nullable();
            $table->decimal('cost_price',10,2)->nullable();
            $table->decimal('fright',10,2)->nullable();
            $table->decimal('clearance',10,2)->nullable();
            $table->decimal('max_discount',10,2)->nullable();
            $table->decimal('price_before_tax',10,2)->nullable();
            $table->boolean('is_taxable')->nullable();
            $table->decimal('unit_price',10,2)->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
