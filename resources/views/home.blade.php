<x-layout style="home" script="home" title="Home">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        <!-- Hero Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Découvrez nos produits</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Trouvez tout ce dont vous avez besoin dans notre sélection soigneusement choisie.</p>
        </div>

   
        <!-- Products Grid -->
        @if($products->isEmpty())
            <div class="no-results rounded-xl p-12 text-center">
                <div class="mx-auto max-w-md">
                    <i class="fas fa-box-open text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-700 mb-2">Aucun produit trouvé</h3>
                    <p class="text-gray-500 mb-6">Nous n'avons trouvé aucun produit correspondant à votre recherche.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 bg-indigo-600 border border-transparent rounded-xl font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm">
                        Réinitialiser les filtres
                    </a>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
                @foreach ($products as $index => $product)
                    <div class="product-card bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300" style="animation-delay: {{ $index * 0.05 }}s">
                        <!-- Product Image -->
                        <div class="relative h-56 bg-gray-50 overflow-hidden group">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" 
                                     alt="{{ $product->name }}" 
                                     class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200">
                                    <i class="fas fa-image text-4xl text-gray-300"></i>
                                </div>
                            @endif
                            
                            <!-- Stock Badge -->
                            @if($product->stock > 5)
                                <span class="stock-badge absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> En stock
                                </span>
                            @elseif($product->stock > 0)
                                <span class="stock-badge absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-circle mr-1"></i> Derniers stocks
                                </span>
                            @else
                                <span class="stock-badge absolute top-3 left-3 px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Épuisé
                                </span>
                            @endif

                            <!-- Quick Actions -->
                            <div class="product-actions absolute bottom-0 w-full bg-gradient-to-t from-black/70 to-transparent p-4">
                                <div class="flex justify-between items-center">
                                    <a href="#" class="text-white hover:text-indigo-200">
                                        <i class="fas fa-heart mr-1.5"></i> <span class="text-sm">Wishlist</span>
                                    </a>
                                    <a href="#" class="flex items-center px-3 py-1.5 bg-indigo-600 rounded-lg text-white hover:bg-indigo-700">
                                        <i class="fas fa-shopping-cart mr-1.5"></i> <span class="text-sm">Ajouter</span>
                                    </a>
                                    {{-- <a href="{{ route('products.show', $product) }}" class="text-white hover:text-indigo-200">
                                        <i class="fas fa-eye mr-1.5"></i> <span class="text-sm">Voir</span>
                                    </a> --}}
                                </div>
                            </div>
                        </div>

                        <!-- Product Info -->
                        <div class="p-5 relative">
                            <h2 class="text-lg font-bold text-gray-900 mb-1 truncate">{{ $product->name }}</h2>
                            <p class="text-gray-500 text-xs mb-2">{{ $product->category->name ?? 'Non catégorisé' }}</p>
                            <p class="text-gray-600 mb-4 line-clamp">{{ $product->description }}</p>
                            
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600">{{ number_format($product->price, 2, ',', ' ') }} €</span>
                                @if($product->stock > 0 && $product->price <= 100)
                                    <span class="text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                                        Livraison gratuite
                                    </span>
                                @endif
                            </div>

                            @if($product->created_at->diffInDays() < 7)
                                <div class="absolute top-4 right-4">
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs font-semibold rounded-full">
                                        Nouveau
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
 
        @endif
        
 
</x-layout>