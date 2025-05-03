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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // Pour les relations User-Product (exemple : wishlists, reviews)
            $table->foreignId('user_id')
                ->constrained('users') // Spécification explicite de la table
                ->cascadeOnDelete(); // Syntaxe Laravel 8+ recommandée

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();
                
            $table->integer('quantity')->default(1);
            $table->decimal('total_price', 10, 2);
            $table->string('status')->default('pending');
            $table->string('payment_method')->default('credit_card');
            $table->string('shipping_address');
            $table->string('billing_address');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
