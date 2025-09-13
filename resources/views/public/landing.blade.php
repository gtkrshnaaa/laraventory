@extends('layouts.public')

@section('title', config('app.name'))

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background Elements (simplified, blue tones) -->
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50 via-transparent to-blue-100"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-blue-50 border-2 border-transparent mb-8">
                    <span class="w-2 h-2 bg-blue-500 rounded-full mr-2"></span>
                    <span class="text-sm font-medium text-blue-700">🏢 Distributor Terpercaya Sejak 1995</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-bold mb-6">
                    <span class="text-blue-700">
                        PT. Mitra
                    </span>
                    <br>
                    <span class="text-gray-900">Elektronik Nusantara</span>
                    <br>
                    <span class="text-blue-600">
                        Parts Center
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto mb-10 leading-relaxed">
                    Distributor terlengkap suku cadang alat elektronik rumah tangga dari 
                    <span class="font-semibold text-blue-600">merk-merk ternama dunia</span>. 
                    Melayani <span class="font-semibold text-blue-600">service center</span>, 
                    <span class="font-semibold text-blue-600">toko elektronik</span>, dan konsumen langsung.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16">
                    <a href="#products" class="rounded-2xl bg-blue-600 hover:bg-blue-700 px-8 py-4 text-lg font-semibold text-white transition-colors duration-200">
                        <span class="flex items-center space-x-3">
                            <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                            <span>Lihat Produk</span>
                            <i data-lucide="arrow-right" class="w-5 h-5"></i>
                        </span>
                    </a>
                    
                    <a href="#brands" class="flex items-center space-x-3 px-8 py-4 text-lg font-semibold text-blue-700 hover:text-blue-900 transition-colors duration-200">
                        <i data-lucide="award" class="w-6 h-6 transition-transform group-hover:scale-110"></i>
                        <span>Merk Unggulan</span>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold text-blue-700 mb-2">30+</div>
                        <div class="text-sm text-gray-600 font-medium">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold text-blue-700 mb-2">15K+</div>
                        <div class="text-sm text-gray-600 font-medium">Jenis Spare Part</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold text-blue-700 mb-2">50+</div>
                        <div class="text-sm text-gray-600 font-medium">Merk Ternama</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold text-blue-700 mb-2">1000+</div>
                        <div class="text-sm text-gray-600 font-medium">Mitra Bisnis</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section id="brands" class="py-20 lg:py-32 bg-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6">
                    Merk <span class="text-blue-700">Unggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami menyediakan spare part original dari brand-brand terpercaya dunia
                </p>
            </div>

            <!-- Brands Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-8">
                @php
                    $brands = array_map(function ($item) {
                        return ['name' => $item['name'], 'logo' => $item['logo'], 'color' => 'from-blue-500 to-blue-600'];
                    }, [
                        ['name' => 'Samsung', 'logo' => 'smartphone'],
                        ['name' => 'LG', 'logo' => 'tv'],
                        ['name' => 'Sharp', 'logo' => 'zap'],
                        ['name' => 'Panasonic', 'logo' => 'radio'],
                        ['name' => 'Toshiba', 'logo' => 'laptop'],
                        ['name' => 'Electrolux', 'logo' => 'washing-machine'],
                        ['name' => 'Daikin', 'logo' => 'snowflake'],
                        ['name' => 'Mitsubishi', 'logo' => 'diamond'],
                        ['name' => 'Polytron', 'logo' => 'speaker'],
                        ['name' => 'Sanken', 'logo' => 'flame'],
                        ['name' => 'Modena', 'logo' => 'chef-hat'],
                        ['name' => 'Aqua', 'logo' => 'droplets']
                    ]);
                @endphp

                @foreach($brands as $brand)
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-2xl p-6 border-2 border-transparent text-center">
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-r {{ $brand['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="{{ $brand['logo'] }}" class="w-8 h-8 text-white"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 text-sm">{{ $brand['name'] }}</h3>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Products Section -->
    <section id="products" class="py-20 lg:py-32 bg-white/20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6">
                    Kategori <span class="text-blue-700">Produk</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Spare part lengkap untuk berbagai jenis alat elektronik rumah tangga
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $categories = array_map(function ($item) {
                        return ['name' => $item['name'], 'icon' => $item['icon'], 'color' => 'from-blue-500 to-blue-600', 'count' => $item['count']];
                    }, [
                        ['name' => 'AC & Pendingin', 'icon' => 'snowflake', 'count' => '2.5K'],
                        ['name' => 'Kulkas & Freezer', 'icon' => 'refrigerator', 'count' => '1.8K'],
                        ['name' => 'Mesin Cuci', 'icon' => 'washing-machine', 'count' => '1.2K'],
                        ['name' => 'TV & Audio', 'icon' => 'tv', 'count' => '3.1K'],
                        ['name' => 'Kompor & Oven', 'icon' => 'flame', 'count' => '950'],
                        ['name' => 'Water Heater', 'icon' => 'droplets', 'count' => '680'],
                        ['name' => 'Rice Cooker', 'icon' => 'chef-hat', 'count' => '540'],
                        ['name' => 'Blender & Mixer', 'icon' => 'zap', 'count' => '420'],
                        ['name' => 'Vacuum Cleaner', 'icon' => 'wind', 'count' => '320'],
                        ['name' => 'Microwave', 'icon' => 'microwave', 'count' => '280']
                    ]);
                @endphp

                @foreach($categories as $category)
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-2xl p-6 border-2 border-transparent text-center">
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-r {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4">
                                    <i data-lucide="{{ $category['icon'] }}" class="w-8 h-8 text-white"></i>
                                </div>
                                <h3 class="font-bold text-gray-900 mb-2 text-sm">{{ $category['name'] }}</h3>
                                <p class="text-xs text-gray-500">{{ $category['count'] }} item</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-24 lg:py-32 bg-white/20 relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-blue-50 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-blue-100 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-blue-50 rounded-full blur-2xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-6xl font-display font-black mb-6">
                    <span class="text-blue-700">
                        Siap Memulai?
                    </span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                    Bergabunglah dengan ribuan bisnis yang telah mempercayakan manajemen inventori mereka kepada kami
                </p>
            </div>

            <!-- CTA Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16">
                
                <!-- For Buyers -->
                <div class="group relative">
                    <div class="relative bg-white border-2 border-transparent rounded-3xl p-8 lg:p-12">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mr-4">
                                <i data-lucide="shopping-cart" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                                    Untuk <span class="text-blue-600">Pembeli</span>
                                </h3>
                                <p class="text-gray-500 font-medium">Service Center • Toko Elektronik • Konsumen</p>
                            </div>
                        </div>
                        
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Dapatkan spare part original dengan harga distributor terbaik. 
                            Stok lengkap, kualitas terjamin, pengiriman cepat ke seluruh Indonesia.
                        </p>
                        
                        <div class="space-y-4">
                            <a href="tel:+62211234567" class="w-full flex items-center justify-center space-x-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-2xl transition-colors duration-200">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                                <span class="text-lg">Hubungi Sales Kami</span>
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </a>
                            
                            <a href="https://wa.me/6281234567890" class="w-full flex items-center justify-center space-x-3 bg-white border-2 border-transparent text-blue-600 hover:text-blue-700 font-semibold py-4 px-8 rounded-2xl hover:bg-blue-50 transition-colors duration-200">
                                <i data-lucide="message-circle" class="w-5 h-5"></i>
                                <span class="text-lg">Chat WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- For Brand Partners -->
                <div class="group relative">
                    <div class="relative bg-white border-2 border-transparent rounded-3xl p-8 lg:p-12">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center mr-4">
                                <i data-lucide="handshake" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                                    Untuk <span class="text-blue-600">Partner</span>
                                </h3>
                                <p class="text-gray-500 font-medium">Brand • Manufacturer • Distributor</p>
                            </div>
                        </div>
                        
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Bergabunglah dengan 50+ brand ternama yang telah mempercayakan 
                            distribusi spare part mereka kepada jaringan nasional kami.
                        </p>
                        
                        <div class="space-y-4">
                            <a href="mailto:partnership@mitraelektronik.co.id" class="w-full flex items-center justify-center space-x-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-4 px-8 rounded-2xl transition-colors duration-200">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                                <span class="text-lg">Jadi Partner Resmi</span>
                                <i data-lucide="arrow-right" class="w-5 h-5"></i>
                            </a>
                            
                            <a href="#" class="w-full flex items-center justify-center space-x-3 bg-white border-2 border-transparent text-blue-600 hover:text-blue-700 font-semibold py-4 px-8 rounded-2xl hover:bg-blue-50 transition-colors duration-200">
                                <i data-lucide="file-text" class="w-5 h-5"></i>
                                <span class="text-lg">Download Proposal</span>
                            </a>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Trust Indicators -->
            <div class="mt-20 text-center">
                <p class="text-gray-500 mb-8 text-lg">Dipercaya oleh</p>
                <div class="flex flex-wrap justify-center items-center gap-8 opacity-60">
                    <div class="text-2xl font-bold text-gray-400">Samsung</div>
                    <div class="text-2xl font-bold text-gray-400">LG</div>
                    <div class="text-2xl font-bold text-gray-400">Panasonic</div>
                    <div class="text-2xl font-bold text-gray-400">Sharp</div>
                    <div class="text-2xl font-bold text-gray-400">Toshiba</div>
                    <div class="text-2xl font-bold text-gray-400">Electrolux</div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
<script>
    // Initialize Lucide icons if needed
    if (window.lucide && lucide.createIcons) {
        lucide.createIcons();
    }
    // No custom animations; keep page lightweight
</script>
@endpush
