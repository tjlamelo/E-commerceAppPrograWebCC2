<x-layout style="form" script="" title="{{ $product->exists ? 'Modification de Produit' : 'Création d\'un Produit' }}">

    <div class="min-h-screen flex flex-col">
        @if ($errors->any())
        <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
            <strong class="font-bold">Oops ! Il y a des erreurs :</strong>
            <ul class="mt-2 list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <!-- Main Content -->
        <main class="flex-grow container mx-auto px-6 py-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Left Side - Form -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white rounded-xl p-6 form-section">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-plus-circle text-indigo-600 mr-3"></i>
                            {{ $product->exists ? 'Modifier '.$product->name : 'Créer un nouveau produit' }}
                        </h2>

                        <form action="{{ $product->exists ? route('admin.update', ['product' => $product->id]) : route('admin.store') }}" method="POST">
                            @csrf
                            @if($product->exists)
                            @method('PUT')
                            <!-- Utilisez PUT au lieu de PATCH -->
                            @endif

                            <!-- Name Input -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-tag text-indigo-500 mr-2 text-sm"></i>
                                    Nom du produit
                                </label>
                                <div class="relative">
                                    <input type="text" value="{{ old('name', $product->name) }}" id="name" name="name" required class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200" placeholder="Nom du produit">
                                    <div class="absolute right-3 top-3 text-gray-400">
                                        <i class="fas fa-check-circle hidden text-green-500" id="nameValid"></i>
                                    </div>
                                </div>
                                @error('name')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Slug Input -->
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-link text-indigo-500 mr-2 text-sm"></i>
                                    Slug (URL)
                                </label>
                                <div class="relative">
                                    <input value="{{ old('slug', $product->slug) }}" type="text" id="slug" name="slug" class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200" placeholder="slug-du-produit">
                                    <div class="absolute right-3 top-3 text-gray-400">
                                        <i class="fas fa-sync-alt cursor-pointer hover:text-indigo-600" id="generateSlug"></i>
                                    </div>
                                </div>
                                @error('slug')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">L'identifiant URL du produit (généré automatiquement)</p>
                            </div>

                            <!-- Description Input -->
                            <div>
                                <label for="description" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-align-left text-indigo-500 mr-2 text-sm"></i>
                                    Description
                                </label>
                                <textarea id="description" name="description" rows="4" class="input-field w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200" placeholder="Décrivez votre produit en détails...">{{ old('description', $product->description) }}</textarea>
                                <div class="flex justify-between items-center mt-1">
                                    @error('description')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Price & Stock -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- Price -->
                                <div>
                                    <label for="price" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                        <i class="fas fa-dollar-sign text-indigo-500 mr-2 text-sm"></i>
                                        Prix (€)
                                    </label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <span class="text-gray-500">€</span>
                                        </div>
                                        <input value="{{ old('price', $product->price) }}" type="number" id="price" name="price" step="0.01" min="0" required class="price-input pl-8 w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200" placeholder="19.99">
                                        <div class="absolute right-3 top-3 text-gray-400">
                                            <i class="fas fa-euro-sign"></i>
                                        </div>
                                        @error('price')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- Stock -->
                                <div>
                                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                        <i class="fas fa-boxes text-indigo-500 mr-2 text-sm"></i>
                                        Stock disponible
                                    </label>
                                    <div class="relative">
                                        <input value="{{ old('stock', $product->stock) }}" type="number" id="stock" name="stock" min="0" required class="stock-input w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500 transition duration-200" placeholder="100">
                                        <div class="absolute right-3 top-3 text-gray-400">
                                            <i class="fas fa-warehouse"></i>
                                        </div>
                                        @error('stock')
                                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Image Upload -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-image text-indigo-500 mr-2 text-sm"></i>
                                    Image du produit
                                </label>

                                <!-- Afficher l'image actuelle si en mode édition -->
                                @if($product->exists && $product->image)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="Image actuelle" width="100" height="100" class="rounded-lg mb-2">
                                    <p class="text-xs text-gray-500 mt-1">Image actuelle</p>
                                </div>
                                @endif

                                <input type="file" name="image" accept="image/*" class="block w-full text-sm text-gray-500 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none focus:border-indigo-500">
                                <p class="mt-1 text-xs text-gray-500">Formats acceptés: JPG, PNG, WEBP (max 2MB)</p>
                                @error('image')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Categories -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1 flex items-center">
                                    <i class="fas fa-tags text-indigo-500 mr-2 text-sm"></i>
                                    Catégories
                                </label>

                                <select name="category_id" id="categorySelect" class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 transition duration-200 bg-white">
                                    <option value="">Sélectionnez une catégorie</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                    @endforeach
                                </select>

                                <p class="mt-1 text-xs text-gray-500">Sélectionnez une catégorie</p>
                                @error('category_id')
                                <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Submit Button -->
                            <div class="pt-4">
                                <button type="submit" class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-medium py-3 px-4 rounded-lg shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center">
                                    <i class="fas {{ $product->exists ? 'fa-save' : 'fa-plus-circle' }} mr-2"></i>
                                    {{ $product->exists ? 'Mettre à jour le produit' : 'Créer le produit' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</x-layout>
