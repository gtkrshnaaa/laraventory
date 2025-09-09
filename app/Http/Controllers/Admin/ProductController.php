<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;

class ProductController extends Controller
{
    /**
     * The number of items to show per page in listings.
     *
     * @var int
     */
    protected $perPage = 10;
    
    /**
     * Display a listing of the products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $search = $request->query('search');
        $category = $request->query('category');
        $status = $request->query('status');

        $query = Product::with(['category', 'supplier']);

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('sku', 'like', "%$search%");
            });
        }
        if ($category) {
            $query->whereHas('category', function ($q) use ($category) {
                $q->where('name', $category)->orWhere('id', $category);
            });
        }
        if ($status === 'low_stock') {
            $query->where('stock', '>', 0)->whereColumn('stock', '<', 'min_stock');
        } elseif ($status === 'out_of_stock') {
            $query->where('stock', '<=', 0);
        } elseif ($status === 'in_stock') {
            $query->where('stock', '>', 0);
        }

        $products = $query->paginate($this->perPage);
        $categories = Category::orderBy('name')->get(['id','name'])->toArray();

        return view('admin.panel.products.index', [
            'title' => 'Daftar Produk',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['name' => 'Produk', 'url' => route('admin.products.index'), 'current' => true],
            ],
            'products' => $products,
            'categories' => $categories,
            'filters' => [
                'search' => $search,
                'category' => $category,
                'status' => $status,
            ],
        ]);
    }

    /**
     * Show the form for creating a new product.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get(['id','name']);
        $suppliers = Supplier::orderBy('name')->get(['id','name']);

        return view('admin.panel.products.create', [
            'title' => 'Tambah Produk Baru',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['name' => 'Produk', 'url' => route('admin.products.index')],
                ['name' => 'Tambah', 'url' => route('admin.products.create'), 'current' => true],
            ],
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'sku' => 'required|string|max:100|unique:products,sku',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0|lt:stock',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'min_stock.lt' => 'Stok minimum harus kurang dari stok saat ini.',
        ]);

        try {
            DB::transaction(function () use ($request, &$imagePath, $validated) {
                $product = Product::create(collect($validated)->except('image')->toArray());

                $imagePath = null;
                if ($request->hasFile('image')) {
                    $imagePath = $request->file('image')->store('products', 'public');
                    $product->update(['image_path' => $imagePath]);
                }
            });

            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produk berhasil ditambahkan');

        } catch (\Exception $e) {
            // Delete the uploaded image if something went wrong
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat menyimpan produk: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified product.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::orderBy('name')->get(['id','name']);
        $suppliers = Supplier::orderBy('name')->get(['id','name']);

        return view('admin.panel.products.edit', [
            'title' => 'Edit Produk',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['name' => 'Produk', 'url' => route('admin.products.index')],
                ['name' => 'Edit', 'url' => route('admin.products.edit', $id), 'current' => true],
            ],
            'product' => $product,
            'categories' => $categories,
            'suppliers' => $suppliers,
        ]);
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        // Validate the request
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'supplier_id' => 'required|exists:suppliers,id',
            'sku' => 'required|string|max:100|unique:products,sku,' . $id,
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'min_stock' => 'required|integer|min:0|lt:stock',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'min_stock.lt' => 'Stok minimum harus kurang dari stok saat ini.',
        ]);

        try {
            DB::transaction(function () use ($request, $product, $validated, &$imagePath) {
                $product->update(collect($validated)->except('image')->toArray());

                if ($request->hasFile('image')) {
                    if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                        Storage::disk('public')->delete($product->image_path);
                    }
                    $imagePath = $request->file('image')->store('products', 'public');
                    $product->update(['image_path' => $imagePath]);
                }
            });
            
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produk berhasil diperbarui');
                
        } catch (\Exception $e) {
            // Delete the uploaded image if something went wrong
            if (isset($imagePath) && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            
            return back()
                ->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui produk: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product->image_path && Storage::disk('public')->exists($product->image_path)) {
                Storage::disk('public')->delete($product->image_path);
            }
            $product->delete();
            
            return redirect()
                ->route('admin.products.index')
                ->with('success', 'Produk berhasil dihapus');
                
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.products.index')
                ->with('error', 'Terjadi kesalahan saat menghapus produk: ' . $e->getMessage());
        }
    }
}

