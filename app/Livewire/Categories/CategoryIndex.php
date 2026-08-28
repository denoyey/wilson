<?php

namespace App\Livewire\Categories;

use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class CategoryIndex extends Component
{
    use WithPagination;

    public string $search = '';
    public int $perPage = 10;

    // Modal state
    public bool $showModal = false;
    public bool $isEditing = false;
    public ?int $editingCategoryId = null;

    // Form fields
    #[Validate('required|string|max:255|unique:categories,name')]
    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    // Delete confirmation
    public bool $showDeleteModal = false;
    public ?int $deletingCategoryId = null;
    public string $deletingCategoryName = '';
    public bool $cannotDelete = false;

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function updatedPerPage(): void
    {
        $this->resetPage();
    }

    /**
     * Open modal for creating a new category.
     */
    public function openCreateModal(): void
    {
        $this->resetForm();
        $this->isEditing = false;
        $this->showModal = true;
    }

    /**
     * Open modal for editing an existing category.
     */
    public function openEditModal(int $categoryId): void
    {
        $category = Category::findOrFail($categoryId);

        $this->editingCategoryId = $category->id;
        $this->name = $category->name;
        $this->description = $category->description ?? '';
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
     * Save category (create or update).
     */
    public function save(): void
    {
        if ($this->isEditing && $this->editingCategoryId) {
            $this->validate([
                'name' => 'required|string|max:255|unique:categories,name,' . $this->editingCategoryId,
                'description' => 'nullable|string',
            ]);

            $category = Category::findOrFail($this->editingCategoryId);
            $category->update([
                'name' => $this->name,
                'description' => $this->description ?: null,
            ]);

            session()->flash('success', 'Kategori "' . $this->name . '" berhasil diperbarui.');
        } else {
            $this->validate();

            Category::create([
                'name' => $this->name,
                'description' => $this->description ?: null,
            ]);

            session()->flash('success', 'Kategori "' . $this->name . '" berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    /**
     * Open delete confirmation modal.
     */
    public function confirmDelete(int $categoryId): void
    {
        $category = Category::withCount('items')->findOrFail($categoryId);
        $this->deletingCategoryId = $category->id;
        $this->deletingCategoryName = $category->name;
        
        // Cek apakah kategori masih dipakai oleh barang
        if ($category->items_count > 0) {
            $this->cannotDelete = true;
        } else {
            $this->cannotDelete = false;
        }

        $this->showDeleteModal = true;
    }

    /**
     * Delete category.
     */
    public function deleteCategory(): void
    {
        if ($this->deletingCategoryId && !$this->cannotDelete) {
            $category = Category::findOrFail($this->deletingCategoryId);
            $category->delete();

            session()->flash('success', 'Kategori "' . $this->deletingCategoryName . '" berhasil dihapus.');
        }

        $this->showDeleteModal = false;
        $this->deletingCategoryId = null;
        $this->deletingCategoryName = '';
    }

    /**
     * Cancel delete.
     */
    public function cancelDelete(): void
    {
        $this->showDeleteModal = false;
        $this->deletingCategoryId = null;
        $this->deletingCategoryName = '';
        $this->cannotDelete = false;
    }

    /**
     * Reset form fields.
     */
    private function resetForm(): void
    {
        $this->reset(['name', 'description', 'editingCategoryId', 'isEditing']);
        $this->resetValidation();
    }

    public function render()
    {
        $categories = Category::withCount('items')
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('description', 'like', '%' . $this->search . '%');
            })
            ->orderBy('name')
            ->paginate($this->perPage);

        return view('livewire.categories.category-index', [
            'categories' => $categories,
        ]);
    }
}