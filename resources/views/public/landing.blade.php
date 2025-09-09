@extends('layouts.public')

@section('title', config('app.name'))

@section('content')
    <!-- Hero Section -->
    <section class="relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute inset-0 bg-gradient-to-br from-ocean-100/50 via-transparent to-mint-100/50"></div>
        <div class="absolute top-20 left-10 w-72 h-72 bg-ocean-200/30 rounded-full blur-3xl animate-float"></div>
        <div class="absolute bottom-20 right-10 w-96 h-96 bg-mint-200/30 rounded-full blur-3xl animate-float" style="animation-delay: 2s;"></div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 lg:py-32">
            <div class="text-center">
                <!-- Badge -->
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-gradient-to-r from-ocean-100 to-mint-100 border border-ocean-200/50 mb-8 animate-slide-up">
                    <span class="w-2 h-2 bg-gradient-to-r from-ocean-500 to-mint-500 rounded-full mr-2 animate-pulse"></span>
                    <span class="text-sm font-medium text-ocean-700">🏢 Distributor Terpercaya Sejak 1995</span>
                </div>

                <!-- Main Heading -->
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-display font-bold mb-6 animate-slide-up" style="animation-delay: 0.1s;">
                    <span class="bg-gradient-to-r from-ocean-600 via-ocean-500 to-mint-600 bg-clip-text text-transparent">
                        PT. Mitra
                    </span>
                    <br>
                    <span class="text-gray-900">Elektronik Nusantara</span>
                    <br>
                    <span class="bg-gradient-to-r from-mint-600 via-mint-500 to-ocean-600 bg-clip-text text-transparent">
                        Parts Center
                    </span>
                </h1>

                <!-- Subtitle -->
                <p class="text-xl lg:text-2xl text-gray-600 max-w-4xl mx-auto mb-10 leading-relaxed animate-slide-up" style="animation-delay: 0.2s;">
                    Distributor terlengkap suku cadang alat elektronik rumah tangga dari 
                    <span class="font-semibold text-ocean-600">merk-merk ternama dunia</span>. 
                    Melayani <span class="font-semibold text-mint-600">service center</span>, 
                    <span class="font-semibold text-ocean-600">toko elektronik</span>, dan konsumen langsung.
                </p>

                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 animate-slide-up" style="animation-delay: 0.3s;">
                    <a href="#products" class="group relative overflow-hidden rounded-2xl bg-gradient-to-r from-ocean-500 to-mint-500 px-8 py-4 text-lg font-semibold text-white shadow-2xl transition-all duration-300 hover:shadow-ocean-500/25 hover:shadow-2xl hover:scale-105">
                        <span class="relative z-10 flex items-center space-x-3">
                            <i data-lucide="shopping-bag" class="w-6 h-6"></i>
                            <span>Lihat Produk</span>
                            <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-ocean-600 to-mint-600 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </a>
                    
                    <a href="#brands" class="group flex items-center space-x-3 px-8 py-4 text-lg font-semibold text-ocean-700 hover:text-ocean-900 transition-colors duration-200">
                        <i data-lucide="award" class="w-6 h-6 transition-transform group-hover:scale-110"></i>
                        <span>Merk Unggulan</span>
                    </a>
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-8 max-w-4xl mx-auto animate-slide-up" style="animation-delay: 0.4s;">
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent mb-2">30+</div>
                        <div class="text-sm text-gray-600 font-medium">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-mint-600 to-ocean-600 bg-clip-text text-transparent mb-2">15K+</div>
                        <div class="text-sm text-gray-600 font-medium">Jenis Spare Part</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent mb-2">50+</div>
                        <div class="text-sm text-gray-600 font-medium">Merk Ternama</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl lg:text-4xl font-bold bg-gradient-to-r from-mint-600 to-ocean-600 bg-clip-text text-transparent mb-2">1000+</div>
                        <div class="text-sm text-gray-600 font-medium">Mitra Bisnis</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Brands Section -->
    <section id="brands" class="py-20 lg:py-32 bg-gradient-to-b from-white to-ocean-50/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6">
                    Merk <span class="bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">Unggulan</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Kami menyediakan spare part original dari brand-brand terpercaya dunia
                </p>
            </div>

            <!-- Brands Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-8">
                @php
                    $brands = [
                        ['name' => 'Samsung', 'logo' => 'smartphone', 'color' => 'from-blue-500 to-blue-600'],
                        ['name' => 'LG', 'logo' => 'tv', 'color' => 'from-red-500 to-pink-500'],
                        ['name' => 'Sharp', 'logo' => 'zap', 'color' => 'from-yellow-500 to-orange-500'],
                        ['name' => 'Panasonic', 'logo' => 'radio', 'color' => 'from-indigo-500 to-purple-500'],
                        ['name' => 'Toshiba', 'logo' => 'laptop', 'color' => 'from-gray-600 to-gray-700'],
                        ['name' => 'Electrolux', 'logo' => 'washing-machine', 'color' => 'from-teal-500 to-cyan-500'],
                        ['name' => 'Daikin', 'logo' => 'snowflake', 'color' => 'from-sky-500 to-blue-500'],
                        ['name' => 'Mitsubishi', 'logo' => 'diamond', 'color' => 'from-red-600 to-red-700'],
                        ['name' => 'Polytron', 'logo' => 'speaker', 'color' => 'from-green-500 to-emerald-500'],
                        ['name' => 'Sanken', 'logo' => 'flame', 'color' => 'from-orange-500 to-red-500'],
                        ['name' => 'Modena', 'logo' => 'chef-hat', 'color' => 'from-purple-500 to-indigo-500'],
                        ['name' => 'Aqua', 'logo' => 'droplets', 'color' => 'from-cyan-500 to-blue-500']
                    ];
                @endphp

                @foreach($brands as $brand)
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-2xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
                            <div class="absolute inset-0 bg-gradient-to-r {{ $brand['color'] }} rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-r {{ $brand['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
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
    <section id="products" class="py-20 lg:py-32 bg-gradient-to-b from-ocean-50/30 to-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-3xl lg:text-5xl font-display font-bold text-gray-900 mb-6">
                    Kategori <span class="bg-gradient-to-r from-ocean-600 to-mint-600 bg-clip-text text-transparent">Produk</span>
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                    Spare part lengkap untuk berbagai jenis alat elektronik rumah tangga
                </p>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-5 gap-6">
                @php
                    $categories = [
                        ['name' => 'AC & Pendingin', 'icon' => 'snowflake', 'color' => 'from-blue-500 to-cyan-500', 'count' => '2.5K'],
                        ['name' => 'Kulkas & Freezer', 'icon' => 'refrigerator', 'color' => 'from-cyan-500 to-teal-500', 'count' => '1.8K'],
                        ['name' => 'Mesin Cuci', 'icon' => 'washing-machine', 'color' => 'from-teal-500 to-emerald-500', 'count' => '1.2K'],
                        ['name' => 'TV & Audio', 'icon' => 'tv', 'color' => 'from-purple-500 to-pink-500', 'count' => '3.1K'],
                        ['name' => 'Kompor & Oven', 'icon' => 'flame', 'color' => 'from-orange-500 to-red-500', 'count' => '950'],
                        ['name' => 'Water Heater', 'icon' => 'droplets', 'color' => 'from-indigo-500 to-blue-500', 'count' => '680'],
                        ['name' => 'Rice Cooker', 'icon' => 'chef-hat', 'color' => 'from-green-500 to-teal-500', 'count' => '540'],
                        ['name' => 'Blender & Mixer', 'icon' => 'zap', 'color' => 'from-yellow-500 to-orange-500', 'count' => '420'],
                        ['name' => 'Vacuum Cleaner', 'icon' => 'wind', 'color' => 'from-gray-500 to-slate-600', 'count' => '320'],
                        ['name' => 'Microwave', 'icon' => 'microwave', 'color' => 'from-pink-500 to-rose-500', 'count' => '280']
                    ];
                @endphp

                @foreach($categories as $category)
                    <div class="group cursor-pointer">
                        <div class="relative bg-white rounded-2xl p-6 border border-gray-100 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
                            <div class="absolute inset-0 bg-gradient-to-r {{ $category['color'] }} rounded-2xl opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                            <div class="relative">
                                <div class="w-16 h-16 bg-gradient-to-r {{ $category['color'] }} rounded-2xl flex items-center justify-center mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
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
    <section class="py-24 lg:py-32 bg-white relative overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute inset-0">
            <div class="absolute top-0 left-1/4 w-72 h-72 bg-gradient-to-br from-ocean-100/30 to-mint-100/30 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-1/4 w-96 h-96 bg-gradient-to-br from-mint-100/20 to-ocean-100/20 rounded-full blur-3xl"></div>
            <div class="absolute top-1/2 left-0 w-64 h-64 bg-gradient-to-br from-ocean-50/40 to-transparent rounded-full blur-2xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Section Header -->
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-6xl font-display font-black mb-6">
                    <span class="bg-gradient-to-r from-ocean-600 via-ocean-500 to-mint-600 bg-clip-text text-transparent">
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
                    <div class="absolute -inset-1 bg-gradient-to-r from-ocean-500 to-mint-500 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white border border-gray-100 rounded-3xl p-8 lg:p-12 shadow-xl hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-ocean-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="shopping-cart" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                                    Untuk <span class="text-ocean-600">Pembeli</span>
                                </h3>
                                <p class="text-gray-500 font-medium">Service Center • Toko Elektronik • Konsumen</p>
                            </div>
                        </div>
                        
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Dapatkan spare part original dengan harga distributor terbaik. 
                            Stok lengkap, kualitas terjamin, pengiriman cepat ke seluruh Indonesia.
                        </p>
                        
                        <div class="space-y-4">
                            <a href="tel:+62211234567" class="group/btn w-full flex items-center justify-center space-x-3 bg-gradient-to-r from-ocean-500 to-ocean-600 hover:from-ocean-600 hover:to-ocean-700 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <i data-lucide="phone" class="w-5 h-5"></i>
                                <span class="text-lg">Hubungi Sales Kami</span>
                                <i data-lucide="arrow-right" class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                            
                            <a href="https://wa.me/6281234567890" class="group/btn w-full flex items-center justify-center space-x-3 bg-white border-2 border-ocean-200 hover:border-ocean-300 text-ocean-600 hover:text-ocean-700 font-semibold py-4 px-8 rounded-2xl hover:bg-ocean-50 transition-all duration-300">
                                <i data-lucide="message-circle" class="w-5 h-5"></i>
                                <span class="text-lg">Chat WhatsApp</span>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- For Brand Partners -->
                <div class="group relative">
                    <div class="absolute -inset-1 bg-gradient-to-r from-mint-500 to-emerald-500 rounded-3xl blur opacity-20 group-hover:opacity-30 transition duration-1000 group-hover:duration-200"></div>
                    <div class="relative bg-white border border-gray-100 rounded-3xl p-8 lg:p-12 shadow-xl hover:shadow-2xl transition-all duration-300">
                        <div class="flex items-center mb-6">
                            <div class="w-16 h-16 bg-gradient-to-br from-mint-500 to-emerald-600 rounded-2xl flex items-center justify-center mr-4 shadow-lg">
                                <i data-lucide="handshake" class="w-8 h-8 text-white"></i>
                            </div>
                            <div>
                                <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">
                                    Untuk <span class="text-mint-600">Partner</span>
                                </h3>
                                <p class="text-gray-500 font-medium">Brand • Manufacturer • Distributor</p>
                            </div>
                        </div>
                        
                        <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                            Bergabunglah dengan 50+ brand ternama yang telah mempercayakan 
                            distribusi spare part mereka kepada jaringan nasional kami.
                        </p>
                        
                        <div class="space-y-4">
                            <a href="mailto:partnership@mitraelektronik.co.id" class="group/btn w-full flex items-center justify-center space-x-3 bg-gradient-to-r from-mint-500 to-emerald-600 hover:from-mint-600 hover:to-emerald-700 text-white font-semibold py-4 px-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 hover:scale-105">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                                <span class="text-lg">Jadi Partner Resmi</span>
                                <i data-lucide="arrow-right" class="w-5 h-5 group-hover/btn:translate-x-1 transition-transform"></i>
                            </a>
                            
                            <a href="#" class="group/btn w-full flex items-center justify-center space-x-3 bg-white border-2 border-mint-200 hover:border-mint-300 text-mint-600 hover:text-mint-700 font-semibold py-4 px-8 rounded-2xl hover:bg-mint-50 transition-all duration-300">
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
    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-slide-up');
            }
        });
    }, observerOptions);

    // Observe all sections
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Parallax effect for background elements
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        const parallaxElements = document.querySelectorAll('.animate-float');
        
        parallaxElements.forEach((element, index) => {
            const speed = 0.5 + (index * 0.1);
            element.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
</script>
@endpush
