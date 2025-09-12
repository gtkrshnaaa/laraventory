@props([
    'method' => 'POST',
    'action' => '',
    'product' => null,
    'categories' => [],
    'suppliers' => [],
])

@php
    $isEdit = $method === 'PUT' || $method === 'PATCH';
    $title = $isEdit ? 'Edit Produk' : 'Tambah Produk Baru';
    $buttonText = $isEdit ? 'Simpan Perubahan' : 'Tambah Produk';
    $product = $product ?? (object) [
        'name' => old('name'),
        'sku' => old('sku'),
        'description' => old('description'),
        'category_id' => old('category_id'),
        'supplier_id' => old('supplier_id'),
        'price' => old('price'),
        'cost' => old('cost'),
        'stock' => old('stock', 0),
        'min_stock' => old('min_stock', 5),
        'image_path' => null,
    ];
@endphp

<form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-6">
    @csrf
    @method($method)
    
    <div class="bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl p-6 transition-all duration-200 hover:shadow-md">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Informasi Produk</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Masukkan detail produk dengan lengkap dan akurat.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Produk <span class="text-red-500">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        <label for="sku" class="block text-sm font-medium text-gray-700">SKU <span class="text-red-500">*</span></label>
                        <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku) }}" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                        @error('sku')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <div class="mt-1">
                            <textarea id="description" name="description" rows="3"
                                class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">{{ old('description', $product->description) }}</textarea>
                        </div>
                        <p class="mt-2 text-sm text-gray-500">Deskripsi singkat tentang produk Anda.</p>
                        @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="category_id" class="block text-sm font-medium text-gray-700">Kategori <span class="text-red-500">*</span></label>
                        <select id="category_id" name="category_id" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                            <option value="">Pilih Kategori</option>
                            @foreach($categories as $category)
                                @php
                                    $catId = is_array($category) ? $category['id'] : $category->id;
                                    $catName = is_array($category) ? $category['name'] : $category->name;
                                @endphp
                                <option value="{{ $catId }}" {{ (old('category_id', $product->category_id) == $catId) ? 'selected' : '' }}>
                                    {{ $catName }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="supplier_id" class="block text-sm font-medium text-gray-700">Supplier <span class="text-red-500">*</span></label>
                        <select id="supplier_id" name="supplier_id" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                            <option value="">Pilih Supplier</option>
                            @foreach($suppliers as $supplier)
                                @php
                                    $supId = is_array($supplier) ? $supplier['id'] : $supplier->id;
                                    $supName = is_array($supplier) ? $supplier['name'] : $supplier->name;
                                @endphp
                                <option value="{{ $supId }}" {{ (old('supplier_id', $product->supplier_id) == $supId) ? 'selected' : '' }}>
                                    {{ $supName }}
                                </option>
                            @endforeach
                        </select>
                        @error('supplier_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="price" class="block text-sm font-medium text-gray-700">Harga Jual <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price) }}" min="0" step="0.01" required
                                class="block w-full pl-12 pr-12 sm:text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50"
                                placeholder="0.00">
                        </div>
                        @error('price')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="cost" class="block text-sm font-medium text-gray-700">Harga Beli <span class="text-red-500">*</span></label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Rp</span>
                            </div>
                            <input type="number" name="cost" id="cost" value="{{ old('cost', $product->cost) }}" min="0" step="0.01" required
                                class="block w-full pl-12 pr-12 sm:text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50"
                                placeholder="0.00">
                        </div>
                        @error('cost')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="stock" class="block text-sm font-medium text-gray-700">Stok Saat Ini <span class="text-red-500">*</span></label>
                        <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock) }}" min="0" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                        @error('stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-6 sm:col-span-3">
                        <label for="min_stock" class="block text-sm font-medium text-gray-700">Stok Minimum <span class="text-red-500">*</span></label>
                        <input type="number" name="min_stock" id="min_stock" value="{{ old('min_stock', $product->min_stock) }}" min="0" required
                            class="mt-1 block w-full px-4 py-2.5 text-sm bg-white/80 backdrop-blur-sm border border-gray-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:border-orange-300 transition-all duration-200 hover:border-orange-300/50">
                        @error('min_stock')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white/80 backdrop-blur-sm border border-orange-200/50 rounded-2xl p-6 transition-all duration-200 hover:shadow-md">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Gambar Produk</h3>
                <p class="mt-1 text-sm text-gray-500">
                    Unggah gambar produk yang menarik.
                </p>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="flex items-center">
                    <div class="flex-shrink-0 h-20 w-20 rounded-md overflow-hidden border border-orange-200/50 bg-orange-50">
                        <img id="image-preview" class="h-full w-full object-cover" 
                            src="{{ $product->image_path ? asset('storage/'.$product->image_path) : 'https://via.placeholder.com/80?text=No+Image' }}" 
                            alt="Product preview">
                    </div>
                    <div class="ml-4">
                        <input type="file" name="image" id="image" accept="image/*" 
                            class="block w-full text-sm text-gray-500
                            file:mr-4 file:py-2 file:px-4
                            file:rounded-md file:border file:border-orange-200/50
                            file:text-sm file:font-semibold
                            file:bg-orange-50 file:text-orange-700
                            hover:file:bg-orange-100">
                        <p class="mt-1 text-xs text-gray-500">
                            Format: JPG, PNG, atau GIF (maks. 2MB)
                        </p>
                        @error('image')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="flex justify-end">
        <button type="button" class="bg-white/80 backdrop-blur-sm py-2.5 px-4 border border-gray-300/50 rounded-xl text-sm font-medium text-gray-700 hover:bg-gray-100/80 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200 hover:-translate-y-0.5 hover:shadow-sm">
            Batal
        </button>
        <button type="submit" class="relative group ml-3 inline-flex justify-center py-2.5 px-6 border border-transparent text-sm font-medium rounded-xl text-white bg-gradient-to-br from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 shadow-sm shadow-orange-200/50 hover:shadow-orange-200 focus:outline-none focus:ring-2 focus:ring-offset-1 focus:ring-orange-500/50 transition-all duration-200 transform hover:-translate-y-0.5">
            <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-white/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200"></div>
            <span class="relative">
                {{ $buttonText }}
            </span>
        </button>
    </div>
</form>

@push('scripts')
<script>
    // Image preview
    document.getElementById('image').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    });

    // Format currency inputs
    const formatCurrency = (input) => {
        // Remove non-numeric characters
        let value = input.value.replace(/[^\d]/g, '');
        
        // Format as currency
        if (value) {
            value = parseInt(value, 10).toLocaleString('id-ID');
            input.value = value;
        }
    };

    // Add event listeners for currency formatting
    document.getElementById('price').addEventListener('blur', function() {
        formatCurrency(this);
    });

    document.getElementById('cost').addEventListener('blur', function() {
        formatCurrency(this);
    });
</script>
@endpush
