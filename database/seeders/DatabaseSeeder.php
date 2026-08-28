<?php

namespace Database\Seeders;

use App\Enums\TransactionType;
use App\Models\Category;
use App\Models\Item;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Create Users
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@wilson.com',
            'password' => 'password',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Budi Santoso (SPV)',
            'username' => 'spv',
            'email' => 'spv@wilson.com',
            'password' => 'password',
            'role' => 'spv',
        ]);

        // 2. Create Categories
        $categories = collect([
            'Elektronik',
            'Bahan Baku',
            'Spare Part',
            'Packaging',
            'Alat Tulis Kantor'
        ])->map(function ($name) {
            return Category::create(['name' => $name]);
        });

        // 3. Create Items
        $itemsData = [
            ['Laptop Dell XPS 15', 'Elektronik', 'pcs', 10],
            ['Kabel Fiber Optik', 'Bahan Baku', 'meter', 500],
            ['Baterai Lithium 12V', 'Spare Part', 'pcs', 45],
            ['Kardus Box Polos A4', 'Packaging', 'box', 200],
            ['Kertas HVS A4 80gsm', 'Alat Tulis Kantor', 'rim', 120],
            ['Keyboard Mechanical', 'Elektronik', 'pcs', 25],
            ['Bubble Wrap 50m', 'Packaging', 'roll', 15],
            ['Baut M4 x 10mm', 'Spare Part', 'pack', 50],
        ];

        $items = collect();
        foreach ($itemsData as $data) {
            $catId = $categories->firstWhere('name', $data[1])->id;
            
            $items->push(Item::create([
                'sku' => Item::generateSku(),
                'name' => $data[0],
                'category_id' => $catId,
                'unit' => $data[2],
                'stock' => $data[3],
            ]));
        }
    }
}
