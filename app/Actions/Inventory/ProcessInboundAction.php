<?php

namespace App\Actions\Inventory;

use App\Enums\TransactionType;
use App\Models\Item;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class ProcessInboundAction
{
    /**
     * Process an inbound (stock in) transaction.
     */
    public function execute(Item $item, int $quantity, string $source, ?string $notes = null): Transaction
    {
        return DB::transaction(function () use ($item, $quantity, $source, $notes) {
            $item->increment('stock', $quantity);

            return Transaction::create([
                'code' => Transaction::generateCode(),
                'item_id' => $item->id,
                'user_id' => auth()->id(),
                'type' => TransactionType::Inbound,
                'quantity' => $quantity,
                'source_or_destination' => $source,
                'notes' => $notes,
            ]);
        });
    }
}
