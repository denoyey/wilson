<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'sku',
        'name',
        'description',
        'category_id',
        'unit',
        'stock',
    ];

    protected $casts = [
        'stock' => 'integer',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }

    /**
     * Generate a unique SKU for a new item.
     */
    public static function generateSku(): string
    {
        $lastItem = static::withTrashed()->orderByDesc('id')->first();
        $nextNumber = $lastItem ? $lastItem->id + 1 : 1;

        return 'WLS-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }
}
