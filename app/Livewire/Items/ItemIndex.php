<?php

namespace App\Livewire\Items;

use App\Models\Category;
use App\Models\Item;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class ItemIndex extends Component
{
    use WithPagination;

    // Search & Filter
    public string $search = '';
    public string $categoryFilter = '';
    public int $perPage = 10;

    // Modal state
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editingItemId = null;

    // Form fields
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('required|exists:categories,id')]
    public string $category_id = '';

    #[Validate('required|string|max:50')]
    public string $unit = '';

    #[Validate('required|integer|min:0')]
    public int $stock = 0;

    // Delete confirmation
    public bool $showDeleteModal = false;
    public ?int $deletingItemId = null;
    public string $deletingItemName = '';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedCategoryFilter(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    /**
     * Open modal for creating a new item.
     */
    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    /**
     * Open modal for editing an existing item.
     */
    public function openEditModal(int $itemId): void
    {
        $item = Item::findOrFail($itemId);

        $this->editingItemId = $item->id;
        $this->name = $item->name;
        $this->description = $item->description ?? '';
        $this->category_id = (string) $item->category_id;
        $this->unit = $item->unit;
        $this->stock = $item->stock;
        $this->isEditing = true;
        $this->showModal = true;
    }

    /**
     * Close modal and reset form.
     */
    public function closeModal(): void
    {
        $this->showModal = false;
        $this->resetForm();
    }

    /**
     * Save item (create or update).
     */
    public function save(): void
    {
        $this->validate();

        if ($this->isEditing && $this->editingItemId) {
            $item = Item::findOrFail($this->editingItemId);
            $item->update([
                'name' => $this->name,
                'description' => $this->description ?: null,
                'category_id' => $this->category_id,
                'unit' => $this->unit,
                'stock' => $this->stock,
            ]);

            session()->flash('success', 'Barang "' . $this->name . '" berhasil diperbarui.');
        } else {
            Item::create([
                'sku' => Item::generateSku(),
                'name' => $this->name,
                'description' => $this->description ?: null,
                'category_id' => $this->category_id,
                'unit' => $this->unit,
                'stock' => $this->stock,
            ]);

            session()->flash('success', 'Barang "' . $this->name . '" berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    /**
     * Open delete confirmation modal.
     */
    public function confirmDelete(int $itemId): void
    {
        $item = Item::findOrFail($itemId);
        $this->deletingItemId = $item->id;
        $this->deletingItemName = $item->name;
        $this->showDeleteModal = true;
    }

    /**
     * Delete item (soft delete).
     */
    public function deleteItem(): void
    {
        if ($this->deletingItemId) {
            $item = Item::findOrFail($this->deletingItemId);
            $item->delete();

            session()->flash('success', 'Barang "' . $this->deletingItemName . '" berhasil dihapus.');
        }

        $this->showDeleteModal = false;
        $this->deletingItemId = null;
        $this->deletingItemName = '';
    }

    /**
     * Cancel delete.
     */
    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deletingItemId = null;
        $this->deletingItemName = '';
    }

    /**
     * Reset form fields.
     */
    private function resetForm(): void
    {
        $this->reset(['name', 'description', 'category_id', 'unit', 'stock', 'editingItemId', 'isEditing']);
        $this->resetValidation();
    }

    public function render()
    {
        $items = Item::with('category')
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')
                       ->orWhere('sku', 'like', '%' . $this->search . '%');
                });
            })
            ->when($this->categoryFilter, function ($query) {
                $query->where('category_id', $this->categoryFilter);
            })
            ->orderBy('name')
            ->paginate($this->perPage);

        $categories = Category::orderBy('name')->get();

        return view('livewire.items.item-index', [
            'items' => $items,
            'categories' => $categories,
        ]);
    }
}