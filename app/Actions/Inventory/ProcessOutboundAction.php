<?php

namespace App\Actions\Inventory;

use App\Enums\TransactionType;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class ProcessOutboundAction
{
    /**
     * Process an outbound (stock out) transaction.
     *
     * @throws ValidationException if quantity exceeds available stock.
     */
    public function execute(Item $item, int $quantity, string $destination, ?string $notes = null): Transaction
    {
        return DB::transaction(function () use ($item, $quantity, $destination, $notes) {
            // Re-fetch with lock to prevent race conditions
            $item = Item::lockForUpdate()->findOrFail($item->id);

            if ($quantity > $item->stock) {
                throw ValidationException::withMessages([
                    'quantity' => "Stok tidak mencukupi. Stok tersedia: {$item->stock}.",
                ]);
            }

            $item->decrement('stock', $quantity);

            return Transaction::create([
                'code' => Transaction::generateCode(),
                'item_id' => $item->id,
                'user_id' => auth()->id(),
                'type' => TransactionType::Outbound,
                'quantity' => $quantity,
                'source_or_destination' => $destination,
                'notes' => $notes,
            ]);
        });
    }
}
