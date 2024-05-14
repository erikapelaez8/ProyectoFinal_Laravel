<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Obtener todas las categorías desde la base de datos
        $categories = Category::all();

        // Definir una lista de colores disponibles
        $colors = ['Red', 'Green', 'Blue', 'Yellow', 'Black', 'White', 'Orange', 'Purple', 'Pink'];

        // Pasar las categorías y los colores a la vista 'create'
        return view('admin.products.create', compact('categories', 'colors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'color' => 'required|in:Red,Green,Blue,Yellow,Black,White,Orange,Purple,Pink',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validación para la imagen
            'category_id' => 'required|exists:categories,id',
        ]);

         // Guardar la imagen
         if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('public/images/products');
            $imageName = basename($imageName); // Obtener solo el nombre del archivo
        }

        // Crear el producto con los datos del formulario
        Product::create([
            'name' => $request->name,
            'brand' => $request->brand,
            'color' => $request->color,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $imageName ?? null,
            'category_id' => $request->category_id,
            'slug' => Str::slug($request->name), // Generar el slug automáticamente
        ]);

        // Redireccionar al usuario a la página de índice de productos con un mensaje de éxito
        return redirect()->route('admin.products.index')
                         ->with('success', 'Product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug/* Product $product */)
    {
        // Obtener el producto por su slug
        $product = Product::where('slug', $slug)->firstOrFail();

        // Retornar la vista show con el producto obtenido
        return view('admin.products.show', compact('product'));
        /* return view('admin.products.show', compact('product')); */
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Obtener el producto por su ID
        $product = Product::findOrFail($id);

         // Obtener todas las categorías desde la base de datos
        $categories = Category::all();

        // Definir una lista de colores disponibles
        $colors = ['Red', 'Green', 'Blue', 'Yellow', 'Black', 'White', 'Orange', 'Purple', 'Pink'];

        // Pasar el producto, las categorías y los colores a la vista 'edit'
        return view('admin.products.edit', compact('product', 'categories', 'colors'));
        /* return view('admin.products.edit', compact('product')); */
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'color' => 'required|in:Red,Green,Blue,Yellow,Black,White,Orange,Purple,Pink',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

         // Initialize imageName variable
        $imageName = $product->image;

        // Upload image if provided
        if ($request->hasFile('image')) {
            $imageName = $request->file('image')->store('public/images/products');
            $imageName = basename($imageName); // Obtener solo el nombre del archivo
        } else {
            // Si no se proporciona una nueva imagen, mantener la imagen existente
            $imageName = $product->image;
        }
        

        $product->update([
            'name' => $request->name,
            'brand' => $request->brand,
            'color' => $request->color,
            'price' => $request->price,
            'description' => $request->description,
            'stock' => $request->stock,
            'image' => $imageName ?? null,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
                         ->with('success', 'Product deleted successfully');
    }
}
