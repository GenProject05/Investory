<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'title',
        'amount',
        'type',
        'category',
        'notes',
        'date'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'date' => 'date',
    ];

    // Scope for income transactions
    public function scopeIncome($query)
    {
        return $query->where('type', 'income');
    }

    // Scope for expense transactions
    public function scopeExpense($query)
    {
        return $query->where('type', 'expense');
    }

    // Get the formatted amount with currency
    public function getFormattedAmountAttribute()
    {
        return 'Rp ' . number_format($this->amount, 2, ',', '.');
    }
}
