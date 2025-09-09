<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewProductController extends Controller
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
        // In a real application, you would fetch products from the database with filters
        $search = $request->query('search');
        $category = $request->query('category');
        $status = $request->query('status');
        
        // Sample data - in a real app, this would be a query
        $products = collect([
            [
                'id' => 1,
                'name' => 'AC Split 1 PK Standard',
                'sku' => 'AC-SPLIT-1PK',
                'category' => 'AC',
                'price' => 3500000,
                'stock' => 15,
                'min_stock' => 5,
                'image_url' => 'https://via.placeholder.com/80?text=AC+Split'
            ],
            [
                'id' => 2,
                'name' => 'Kulkas 2 Pintu 300L',
                'sku' => 'KULKAS-2P-300L',
                'category' => 'Kulkas',
                'price' => 4500000,
                'stock' => 3,
                'min_stock' => 5,
                'image_url' => 'https://via.placeholder.com/80?text=Kulkas+2P'
            ],
            [
                'id' => 3,
                'name' => 'Mesin Cuci 8KG Front Load',
                'sku' => 'MESIN-CUCI-8KG',
                'category' => 'Mesin Cuci',
                'price' => 5200000,
                'stock' => 8,
                'min_stock' => 4,
                'image_url' => 'https://via.placeholder.com/80?text=Mesin+Cuci'
            ],
            [
                'id' => 4,
                'name' => 'TV LED 32 Inch',
                'sku' => 'TV-LED-32',
                'category' => 'TV',
                'price' => 2800000,
                'stock' => 0,
                'min_stock' => 3,
                'image_url' => 'https://via.placeholder.com/80?text=TV+32'
            ],
            [
                'id' => 5,
                'name' => 'Kompor Gas 2 Tungku',
                'sku' => 'KOMPOR-GAS-2T',
                'category' => 'Kompor',
                'price' => 750000,
                'stock' => 2,
                'min_stock' => 5,
                'image_url' => 'https://via.placeholder.com/80?text=Kompor+Gas'
            ]
        ]);
        
        // Apply filters if provided
        if ($search) {
            $products = $products->filter(function($product) use ($search) {
                return str_contains(strtolower($product['name']), strtolower($search)) || 
                       str_contains(strtolower($product['sku']), strtolower($search));
            });
        }
        
        if ($category) {
            $products = $products->where('category', $category);
        }
        
        if ($status === 'low_stock') {
            $products = $products->filter(function($product) {
                return $product['stock'] > 0 && $product['stock'] < $product['min_stock'];
            });
        } elseif ($status === 'out_of_stock') {
            $products = $products->where('stock', '<=', 0);
        } elseif ($status === 'in_stock') {
            $products = $products->where('stock', '>', 0);
        }
        
        // Sample categories - in a real app, this would come from the database
        $categories = [
            ['id' => 1, 'name' => 'AC'],
            ['id' => 2, 'name' => 'Kulkas'],
            ['id' => 3, 'name' => 'Mesin Cuci'],
            ['id' => 4, 'name' => 'TV'],
            ['id' => 5, 'name' => 'Kompor'],
        ];
        
        return view('admin.products.index', [
            'title' => 'Daftar Produk',
            'breadcrumbs' => [
                ['name' => 'Dashboard', 'url' => route('admin.dashboard')],
                ['name' => 'Produk', 'url' => route('admin.products.index'), 'current' => true],
            ],
            'products' => $products->values()->all(),
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
        // Sample data - in a real app, this would be a database query
        $categories = [
            ['id' => 1, 'name' => 'AC'],
            ['id' => 2, 'name' => 'Kulkas'],
            ['id' => 3, 'name' => 'Mesin Cuci'],
            ['id' => 4, 'name' => 'TV'],
            ['id' => 5, 'name' => 'Kompor'],
            ['id' => 6, 'name' => 'Kipas Angin'],
            ['id' => 7, 'name' => 'Blender'],
            ['id' => 8, 'name' => 'Microwave'],
        ];
        
        $suppliers = [
            ['id' => 1, 'name' => 'PT. Elektronik Sejahtera'],
            ['id' => 2, 'name' => 'CV. Sumber Barokah Elektronik'],
            ['id' => 3, 'name' => 'UD. Jaya Abadi'],
            ['id' => 4, 'name' => 'Toko Elektronik Maju Jaya'],
        ];
        
        return view('admin.products.create', [
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
            // In a real application, you would store the product here
            // $product = Product::create($validated);
            
            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('image')) {
                // $imagePath = $request->file('image')->store('products', 'public');
                // $product->update(['image_path' => $imagePath]);
            }
            
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
        // In a real application, you would fetch the product from the database
        // $product = Product::findOrFail($id);
        
        // Sample product data - replace with actual database query
        $product = [
            'id' => $id,
            'name' => 'AC Split 1 PK Standard',
            'sku' => 'AC-SPLIT-1PK',
            'description' => 'AC Split 1 PK dengan teknologi inverter hemat listrik',
            'category_id' => 1,
            'supplier_id' => 1,
            'price' => 3500000,
            'cost' => 2800000,
            'stock' => 15,
            'min_stock' => 5,
            'image_url' => 'https://via.placeholder.com/300x300?text=AC+Split+1PK',
        ];
        
        // Sample categories - in a real app, this would be a database query
        $categories = [
            ['id' => 1, 'name' => 'AC'],
            ['id' => 2, 'name' => 'Kulkas'],
            ['id' => 3, 'name' => 'Mesin Cuci'],
            ['id' => 4, 'name' => 'TV'],
            ['id' => 5, 'name' => 'Kompor'],
        ];
        
        // Sample suppliers - in a real app, this would be a database query
        $suppliers = [
            ['id' => 1, 'name' => 'PT. Elektronik Sejahtera'],
            ['id' => 2, 'name' => 'CV. Sumber Barokah Elektronik'],
            ['id' => 3, 'name' => 'UD. Jaya Abadi'],
            ['id' => 4, 'name' => 'Toko Elektronik Maju Jaya'],
        ];
        
        return view('admin.products.edit', [
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
        // In a real application, you would fetch the product first
        // $product = Product::findOrFail($id);
        
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
            // In a real application, you would update the product here
            // $product->update($validated);
            
            // Handle image upload if present
            $imagePath = null;
            if ($request->hasFile('image')) {
                // Delete old image if exists
                // if ($product->image_path) {
                //     Storage::disk('public')->delete($product->image_path);
                // }
                // $imagePath = $request->file('image')->store('products', 'public');
                // $product->update(['image_path' => $imagePath]);
            }
            
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
            // In a real application, you would delete the product here
            // $product = Product::findOrFail($id);
            
            // Check if product has any transactions or stock movements
            // if ($product->transactions()->exists() || $product->stockMovements()->exists()) {
            //     return redirect()
            //         ->route('admin.products.index')
            //         ->with('error', 'Tidak dapat menghapus produk yang memiliki riwayat transaksi atau pergerakan stok');
            // }
            
            // Delete the product image if exists
            // if ($product->image_path) {
            //     Storage::disk('public')->delete($product->image_path);
            // }
            
            // $product->delete();
            
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
