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
            $table->string('title'); // Judul transaksi
            $table->decimal('amount', 15, 2); // Jumlah transaksi
            $table->enum('type', ['income', 'expense']); // Jenis: pendapatan/pengeluaran
            $table->enum('category', [
                // Income categories
                'salary', 'side_income', 'investment_return', 'donation_received', 'passive_income', 'unexpected_income',
                // Expense categories
                'living_expenses', 'shopping', 'investment_expense', 'savings', 'debts', 'entertainment', 'education',
                'health', 'emergency', 'donation_given'
            ]); // Kategori transaksi
            $table->text('notes')->nullable(); // Catatan transaksi
            $table->date('date'); // Tanggal transaksi
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
