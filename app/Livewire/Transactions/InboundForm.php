<?php

namespace App\Livewire\Transactions;

use App\Actions\Inventory\ProcessInboundAction;
use App\Models\Item;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

#[Layout('components.layouts.app')]
class InboundForm extends Component
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('required|exists:categories,id')]
    public string $category_id = '';

    #[Validate('required|integer|min:1')]
    public int $quantity = 1;

    #[Validate('required|string|max:50')]
    public string $unit = '';

    #[Validate('nullable|string|max:255')]
    public string $source = '';

    #[Validate('nullable|string')]
    public string $notes = '';

    public function save(ProcessInboundAction $action)
    {
        $this->validate();

        try {
            // Because user explicitly wants to create items on inbound, 
            // we create a new master item first for every inbound transaction.
            $item = Item::create([
                'sku' => Item::generateSku(),
                'name' => $this->name,
                'category_id' => $this->category_id,
                'unit' => $this->unit,
                'stock' => 0, // Stock will be added by ProcessInboundAction
            ]);

            $action->execute(
                $item,
                $this->quantity,
                $this->source ?: '',
                $this->notes ?: null
            );

            session()->flash('success', 'Barang baru dan transaksi masuk berhasil dicatat.');
            return $this->redirectRoute('dashboard', navigate: true);
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat memproses transaksi: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.transactions.inbound-form', [
            'categories' => Category::orderBy('name')->get(),
        ]);
    }
}