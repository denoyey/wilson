<?php

namespace App\Models;

use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'code',
        'item_id',
        'user_id',
        'type',
        'quantity',
        'source_or_destination',
        'notes',
    ];

    protected $casts = [
        'type' => TransactionType::class,
        'quantity' => 'integer',
    ];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Generate a unique transaction code.
     */
    public static function generateCode(): string
    {
        $today = now()->format('Ymd');
        $lastTransaction = static::where('code', 'like', "TRX-{$today}-%")
            ->orderByDesc('id')
            ->first();

        $nextNumber = 1;
        if ($lastTransaction) {
            $parts = explode('-', $lastTransaction->code);
            $nextNumber = (int) end($parts) + 1;
        }

        return "TRX-{$today}-" . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
    }

    /**
     * Scope: only inbound transactions.
     */
    public function scopeInbound($query)
    {
        return $query->where('type', TransactionType::Inbound);
    }

    /**
     * Scope: only outbound transactions.
     */
    public function scopeOutbound($query)
    {
        return $query->where('type', TransactionType::Outbound);
    }

    /**
     * Scope: transactions created today.
     */
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    /**
     * Scope: transactions created this month.
     */
    public function scopeThisMonth($query)
    {
        return $query->whereYear('created_at', now()->year)
                     ->whereMonth('created_at', now()->month);
    }
}
