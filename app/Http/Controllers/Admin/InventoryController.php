<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\InventoryMovement;

class InventoryController extends Controller
{
    // Show inventory overview
    public function index(): View
    {
        $products = Product::with('category')
            ->orderBy('name')
            ->paginate(15);

        $lowStock = Product::where('stock', '>', 0)
            ->whereColumn('stock', '<', 'min_stock')
            ->orderBy('stock')
            ->take(10)
            ->get();

        return view('admin.panel.inventory.index', [
            'products' => $products,
            'lowStock' => $lowStock,
        ]);
    }

    // Adjust inventory quantities
    public function adjust(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'type' => 'required|in:in,out',
            'quantity' => 'required|integer|min:1',
            'note' => 'nullable|string',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $product = Product::lockForUpdate()->findOrFail($data['product_id']);

                if ($data['type'] === 'out') {
                    if ($product->stock < $data['quantity']) {
                        abort(422, 'Jumlah keluar melebihi stok yang tersedia');
                    }
                    $product->stock -= $data['quantity'];
                } else {
                    $product->stock += $data['quantity'];
                }
                $product->save();

                InventoryMovement::create([
                    'product_id' => $product->id,
                    'type' => $data['type'],
                    'quantity' => $data['quantity'],
                    'note' => $data['note'] ?? null,
                    'created_by' => optional(auth('admin')->user())->id,
                ]);
            });

            return redirect()->route('admin.inventory.index')->with('status', 'Inventory adjusted');
        } catch (\Throwable $e) {
            return back()->withInput()->withErrors(['adjust' => $e->getMessage()]);
        }
    }
}
