<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index(): View
    {
        $suppliers = Supplier::orderBy('name')->paginate(10);
        return view('admin.panel.suppliers.index', compact('suppliers'));
    }

    public function create(): View
    {
        return view('admin.panel.suppliers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);

        Supplier::create($validated);
        return redirect()->route('admin.suppliers.index')->with('status', 'Supplier created');
    }

    public function edit(int $supplier): View
    {
        $model = Supplier::findOrFail($supplier);
        return view('admin.panel.suppliers.edit', ['supplier' => $model]);
    }

    public function update(Request $request, int $supplier): RedirectResponse
    {
        $model = Supplier::findOrFail($supplier);
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:100',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ]);
        $model->update($validated);
        return redirect()->route('admin.suppliers.index')->with('status', 'Supplier updated');
    }

    public function destroy(int $supplier): RedirectResponse
    {
        $model = Supplier::findOrFail($supplier);
        // Optional: prevent delete if related products exist
        // if ($model->products()->exists()) {
        //     return redirect()->route('admin.suppliers.index')->with('status', 'Cannot delete supplier with products');
        // }
        $model->delete();
        return redirect()->route('admin.suppliers.index')->with('status', 'Supplier deleted');
    }
}

