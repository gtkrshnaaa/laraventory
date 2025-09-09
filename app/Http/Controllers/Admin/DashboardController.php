<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // In a real application, you would fetch these from your database
        $stats = [
            'total_products' => 124,
            'total_stock' => 2458,
            'total_categories' => 12,
            'total_suppliers' => 8,
        ];

        // Sample recent activities
        $recent_activities = [
            [
                'type' => 'product',
                'message' => 'Produk <span class="font-medium">AC Split 1 PK</span> ditambahkan',
                'time' => now()->subMinutes(15),
                'time_ago' => '15 menit yang lalu'
            ],
            [
                'type' => 'stock',
                'message' => 'Stok <span class="font-medium">Kulkas 2 Pintu</span> berkurang menjadi 5',
                'time' => now()->subHours(2),
                'time_ago' => '2 jam yang lalu'
            ],
            [
                'type' => 'stock',
                'message' => 'Stok <span class="font-medium">Mesin Cuci 8kg</span> ditambahkan sebanyak 10 unit',
                'time' => now()->subDays(1),
                'time_ago' => 'Kemarin'
            ],
            [
                'type' => 'product',
                'message' => 'Produk <span class="font-medium">TV LED 32 Inch</span> diperbarui',
                'time' => now()->subDays(2),
                'time_ago' => '2 hari yang lalu'
            ],
            [
                'type' => 'other',
                'message' => 'Laporan bulanan telah dihasilkan',
                'time' => now()->subWeeks(1),
                'time_ago' => '1 minggu yang lalu'
            ],
        ];

        // Sample low stock products
        $low_stock_products = [
            [
                'id' => 1,
                'name' => 'Kompor Gas 2 Tungku',
                'stock' => 2,
                'min_stock' => 5,
                'category' => 'Dapur',
                'status' => 'Stok kritis'
            ],
            [
                'id' => 2,
                'name' => 'Kipas Angin 16"',
                'stock' => 3,
                'min_stock' => 10,
                'category' => 'Elektronik',
                'status' => 'Stok menipis'
            ],
            [
                'id' => 3,
                'name' => 'Blender 350W',
                'stock' => 4,
                'min_stock' => 8,
                'category' => 'Dapur',
                'status' => 'Stok menipis'
            ]
        ];

        return view('admin.panel.dashboard.index', [
            'title' => 'Dashboard',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard'), 'current' => true],
            ],
            'stats' => $stats,
            'recent_activities' => $recent_activities,
            'low_stock_products' => $low_stock_products,
        ]);
    }
}
