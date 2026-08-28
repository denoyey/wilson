<?php

namespace App\Livewire\Transactions;

use App\Actions\Inventory\ProcessOutboundAction;
use App\Models\Item;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
class OutboundForm extends Component
{
    #[Validate('required|exists:items,id')]
    public $item_id = '';

    #[Validate('required|integer|min:1')]
    public $quantity = '';

    #[Validate('required|string|max:255')]
    public $destination = '';

    #[Validate('nullable|string')]
    public $notes = '';

    public function save(ProcessOutboundAction $action)
    {
        $this->validate();

        $item = Item::findOrFail($this->item_id);

        try {
            $action->execute($item, $this->quantity, $this->destination, $this->notes);
            
            session()->flash('success', 'Transaksi barang keluar berhasil dicatat. Stok barang otomatis berkurang.');
            
            return $this->redirect(route('dashboard'), navigate: true);
        } catch (ValidationException $e) {
            // Re-throw validation exceptions so Livewire handles them
            throw $e;
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memproses transaksi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // Only show items that have stock > 0
        $items = Item::where('stock', '>', 0)->orderBy('name')->get();
        return view('livewire.transactions.outbound-form', [
            'items' => $items,
        ]);
    }
}
