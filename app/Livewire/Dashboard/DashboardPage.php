<?php

namespace App\Livewire\Dashboard;

use App\Models\Item;
use App\Models\Transaction;
use Livewire\Attributes\Layout;
use Livewire\Component;

use Livewire\WithPagination;

#[Layout('components.layouts.app')]
class DashboardPage extends Component
{
    use WithPagination;

    public int $perPage = 10;

    public function render()
    {
        $user = auth()->user();
        $isAdmin = $user->isAdmin();

        $totalStock = Item::sum('stock');
        
        $monthlyInbound = 0;
        $monthlyOutbound = 0;
        $recentTransactions = collect();
        $readyItems = collect();
        $outOfStockItems = collect();

        if ($isAdmin) {
            $monthlyInbound = Transaction::inbound()->thisMonth()->sum('quantity');
            $monthlyOutbound = Transaction::outbound()->thisMonth()->sum('quantity');
            $recentTransactions = Transaction::with(['item', 'user'])
                ->latest()
                ->paginate($this->perPage);
        } else {
            $readyItems = Item::with('category')
                ->where('stock', '>', 0)
                ->orderBy('name')
                ->get();

            $outOfStockItems = Item::with('category')
                ->where('stock', '<=', 0)
                ->orderBy('name')
                ->get();
        }

        return view('livewire.dashboard.dashboard-page', [
            'isAdmin' => $isAdmin,
            'totalStock' => $totalStock,
            'monthlyInbound' => $monthlyInbound,
            'monthlyOutbound' => $monthlyOutbound,
            'recentTransactions' => $recentTransactions,
            'readyItems' => $readyItems,
            'outOfStockItems' => $outOfStockItems,
        ]);
    }
}
