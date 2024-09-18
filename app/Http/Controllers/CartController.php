<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        
        // Fetch the product from the database
        $product = Product::find($productId);
        
        // Debug output
        // if ($product) {
        //     dd($product);
        // } else {
        //     return redirect()->back()->with('error', 'Product not found!');
        // }
    
        $cart = Session::get('cart', []);
    
        if (!isset($cart[$productId])) {
            // Add product details to the session cart
            $cart[$productId] = [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
                'image' => $product->image // Store the image path
            ];
        } else {
            // Increment the quantity if the product is already in the cart
            $cart[$productId]['quantity'] += 1;
        }
    
        Session::put('cart', $cart);
    
        return redirect()->back()->with('success', 'Product added to cart!');
    }    
    
    public function show()
{
    $cartItems = session('cart', []);
    
    // Debug the cart session contents
  //  dd($cartItems); // Check what data is being stored
    
    return view('cart.show', compact('cartItems'));
}

    public function remove($productId)
    {
        $cart = Session::get('cart', []);
        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
        }
        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function confirm()
    {
        Session::forget('cart');
        return redirect()->route('cart')->with('success', 'Order confirmed successfully!');
    }
}
