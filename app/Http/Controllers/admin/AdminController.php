<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Http\Requests\ProductRequest;
class AdminController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view("admin.admin", compact('products'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return $this->showFrom();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return $this->showFrom($product);
    }

    protected function showFrom(Product $product = new Product): View
    {
        $categories = Category::all();

        return view('admin.form', [
            'product' => $product,
            'categories' => Category::orderBy('name')->get(),

        ]);

    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request): RedirectResponse
    {

        return $this->save($request->validated());

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        return $this->save($request->validated(), $product);
    }

    protected function save(array $data, Product $product = null): RedirectResponse
    {
        if (request()->hasFile('image')) {
            if ($product && $product->image) {
                Storage::delete($product->image);
            }
            $data['image'] = request()->file('image')->store('products');
        } elseif ($product && $product->image) {
            // Conserver l'image existante si aucune nouvelle image n'est fournie
            $data['image'] = $product->image;

        }

        $product = Product::updateOrCreate(['id' => $product?->id], $data);

        return redirect()
            ->route('admin.show', ['product' => $product->id])
            ->with('status', 'Opération effectuée avec succès');
    }
    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.show', compact('product'));
    }






    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        // Supprime l'image si elle existe
        if ($product->image) {
            Storage::delete($product->image);
        }
    
        // Supprime le produit de la base de données
        $product->delete();
    
        // Redirige avec un message de succès
        return redirect()
            ->route('admin.index')
            ->with('status', 'Produit supprimé avec succès');
    }
}
