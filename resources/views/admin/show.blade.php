<x-layout style="form" script="" title="{{ $product->name }} - Détails">
    <div class="container mx-auto px-6 py-8">
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $product->name }}</h1>

                <!-- Image -->
                @if($product->image)
                    <div class="mb-4">
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="Image du produit" 
                             class="w-40 h-40 object-cover rounded shadow-sm">
                    </div>
                @else
                    <p class="text-gray-500">Aucune image disponible</p>
                @endif

                <!-- Description -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Description</h2>
                    <p class="text-gray-600">{{ $product->description ?: 'Aucune description' }}</p>
                </div>

                <!-- Prix -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Prix</h2>
                    <p class="text-gray-600">{{ number_format($product->price, 2, ',', '.') }} €</p>
                </div>

                <!-- Stock -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Stock</h2>
                    <p class="text-gray-600">
                        {{ $product->stock }}
                        {{ $product->stock > 1 ? 'unités disponibles' : 'unité disponible' }}
                    </p>
                </div>

                <!-- Catégorie -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Catégorie</h2>
                    <p class="text-gray-600">{{ $product->category?->name ?? 'Non catégorisé' }}</p>
                </div>

                <!-- Slug -->
                <div class="mb-4">
                    <h2 class="text-xl font-semibold text-gray-700 mb-2">Slug</h2>
                    <p class="text-gray-600">{{ $product->slug }}</p>
                </div>

                <!-- Boutons -->
                <div class="mt-6 flex space-x-4">
                    <a href="{{ route('admin.edit', ['product' => $product->id]) }}" 
                       class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-2 px-4 rounded-lg">
                        Modifier
                    </a>

                    <form action="{{ route('admin.destroy', ['product' => $product->id]) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-lg">
                            Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout>