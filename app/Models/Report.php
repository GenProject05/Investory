<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'start_date', 'end_date', 'total_income', 'total_expense'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
