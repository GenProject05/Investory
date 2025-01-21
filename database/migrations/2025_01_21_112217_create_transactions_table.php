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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // title transaction
            $table->decimal('amount', 15, 2); // amount transaction
            $table->enum('type', ['income', 'expense']); // transaction type
            $table->enum('category', [
                // Income categories
                'salary', 'side_income', 'investment_return', 'donation_received', 'passive_income', 'unexpected_income',
                // Expense categories
                'living_expenses', 'shopping', 'investment_expense', 'savings', 'debts', 'entertainment', 'education',
                'health', 'emergency', 'donation_given'
            ]); // transaction category
            $table->text('notes')->nullable(); // notes transaction
            $table->date('date'); // date transaction
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
