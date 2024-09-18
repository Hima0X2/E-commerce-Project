<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image'
        ]);

        $imagePath = $request->file('image')->store('public/images');

        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => basename($imagePath),
        ]);

        return redirect()->route('admin.products')->with('success', 'Product added successfully!');
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->only('name', 'price');

        if ($request->hasFile('image')) {
            // Store the image and get its path
            $imagePath = $request->file('image')->store('images', 'public');
            $data['image'] = $imagePath;

            // Delete old image if it exists
            if ($product->image && Storage::exists('public/' . $product->image)) {
                Storage::delete('public/' . $product->image);
            }
        }

        $product->update($data);

        return redirect()->route('admin.products')->with('success', 'Product updated successfully');
    }
    public function destroy(Product $product)
    {
    
        Storage::delete('public/images/' . $product->image);
        $product->delete();
    
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }    
}
