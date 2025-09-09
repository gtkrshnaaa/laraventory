<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use App\Models\Product;
use App\Models\InventoryMovement;

class ReportController extends Controller
{
    public function stock(): View
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->get();
        return view('admin.panel.reports.stock', compact('products'));
    }

    public function transactions(): View
    {
        $movements = InventoryMovement::with(['product' => function($q){ $q->select('id','name','sku'); }])
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('admin.panel.reports.transactions', compact('movements'));
    }

    public function export(Request $request): JsonResponse
    {
        // TODO: implement export
        return response()->json(['status' => 'queued']);
    }
}
