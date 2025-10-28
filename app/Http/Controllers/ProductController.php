<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show all products
    public function index() 
    {
        return response()->json(Product::all());
    }

    // Store new product
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'details' => 'nullable|string',
            'regular_price' => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'images.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // validate multiple files
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('products', 'public'); // stores in storage/app/public/products
                $imagePaths[] = asset('storage/' . $path);
            }
        }

        $product = Product::create([
            'name' => $data['name'],
            'details' => $data['details'] ?? null,
            'regular_price' => $data['regular_price'],
            'discounted_price' => $data['discounted_price'] ?? null,
            'images' => $imagePaths,
        ]);

        return response()->json($product, 201);
    }


    // Show single product
    public function show($id)
    {
        return response()->json(Product::findOrFail($id));
    }

    // Update product
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name' => 'sometimes|string|max:255',
            'details' => 'nullable|string',
            'regular_price' => 'sometimes|numeric',
            'discounted_price' => 'nullable|numeric',
            'images' => 'nullable|array',
        ]);

        $product->update($data);
        return response()->json($product);
    }

    // Delete product
    public function destroy($id)
    {
        Product::findOrFail($id)->delete();
        return response()->json(['message' => 'Product deleted successfully']);
    }
}
