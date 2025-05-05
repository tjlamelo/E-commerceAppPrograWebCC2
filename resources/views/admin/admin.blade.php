<x-layout style="tailwind" script="" title="Liste des Produits">
    <div class="container mx-auto px-4 py-8 fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Gestion des Produits</h1>
                <p class="text-gray-500 mt-2">Gérez l'inventaire de votre boutique</p>
            </div>
            
            <!-- Search and Add Product -->
            <div class="flex flex-col sm:flex-row gap-4 mt-4 md:mt-0">
                <div class="relative">
                    <input type="text" 
                           placeholder="Rechercher un produit..." 
                           class="search-input pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 w-full">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                </div>
                <a href="{{ route('admin.create') }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-lg font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 shadow-sm transition-all duration-200">
                    <i class="fas fa-plus-circle mr-2"></i> Nouveau produit
                </a>
            </div>
        </div>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Produits total</p>
                        <h3 class="text-2xl font-bold text-gray-800 mt-1"> </h3>
                    </div>
                    <div class="p-3 bg-indigo-50 rounded-full text-indigo-600">
                        <i class="fas fa-box-open text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">En stock</p>
                        <h3 class="text-2xl font-bold text-green-600 mt-1"> </h3>
                    </div>
                    <div class="p-3 bg-green-50 rounded-full text-green-600">
                        <i class="fas fa-check-circle text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Rupture de stock</p>
                        <h3 class="text-2xl font-bold text-red-600 mt-1"> </h3>
                    </div>
                    <div class="p-3 bg-red-50 rounded-full text-red-600">
                        <i class="fas fa-exclamation-circle text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Catégories</p>
                        <h3 class="text-2xl font-bold text-purple-600 mt-1"> </h3>
                    </div>
                    <div class="p-3 bg-purple-50 rounded-full text-purple-600">
                        <i class="fas fa-tags text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Products Table -->
        <div class="bg-white shadow-lg rounded-xl overflow-hidden border border-gray-100">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Produit</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Catégorie</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100">
                        @foreach($products as $product)
                        <tr class="product-row transition-all duration-200 hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        @if($product->image)
                                        <img class="h-10 w-10 rounded-lg object-cover" src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                        @else
                                        <div class="h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-500">ID: {{ $product->id }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $product->category->name ?? 'Non catégorisé' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ number_format($product->price, 2, ',', ' ') }} €
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($product->stock > 5)
                                <span class="status-badge px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    <i class="fas fa-check-circle mr-1"></i> {{ $product->stock }} en stock
                                </span>
                                @elseif($product->stock > 0)
                                <span class="status-badge px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-exclamation-triangle mr-1"></i> {{ $product->stock }} restant(s)
                                </span>
                                @else
                                <span class="status-badge px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                    <i class="fas fa-times-circle mr-1"></i> Rupture
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex justify-end space-x-2">
                                    <a href="{{ route('admin.edit', $product) }}" 
                                       class="action-btn text-indigo-600 hover:text-indigo-900 flex items-center px-3 py-1.5 bg-indigo-50 rounded-lg">
                                        <i class="fas fa-edit mr-1.5"></i> Éditer
                                    </a>
                                    <form action="{{ route('admin.destroy', $product) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="action-btn text-red-600 hover:text-red-900 flex items-center px-3 py-1.5 bg-red-50 rounded-lg mr-2"
                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce produit?')">
                                            <i class="fas fa-trash mr-1.5"></i> Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- Pagination -->
            <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                <div class="text-sm text-gray-500">
                    Affichage de <span class="font-medium">1</span> à <span class="font-medium">10</span> sur <span class="font-medium"><?php echo count($products); ?></span> résultats
                </div>
                <div class="flex space-x-2">
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Précédent
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700">
                        1
                    </button>
                    <button class="px-3 py-1 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        Suivant
                    </button>
                </div>
            </div>
        </div>
    </div>

</x-layout>
