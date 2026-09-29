<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $query    = Product::where('is_active', true);
        $category = $request->get('category');

        if ($category && in_array($category, ['film_roll', 'print', 'accessory'])) {
            $query->where('category', $category);
        }

        $products = $query->get();
        return view('shop.index', compact('products', 'category'));
    }

    public function cart()
    {
        $cart     = session()->get('cart', []);
        $products = [];
        $total    = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal   = $product->price * $item['quantity'];
                $total     += $subtotal;
                $products[] = ['product' => $product, 'quantity' => $item['quantity'], 'subtotal' => $subtotal];
            }
        }

        return view('shop.cart', compact('products', 'total'));
    }

    public function addToCart(Request $request, Product $product)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);
        $quantity = $request->quantity;

        if ($quantity > $product->stock) {
            return back()->with('error', 'Not enough stock available.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            $cart[$product->id] = ['quantity' => $quantity];
        }

        session()->put('cart', $cart);
        return back()->with('success', "{$product->name} added to cart.");
    }

    public function removeFromCart(Product $product)
    {
        $cart = session()->get('cart', []);
        unset($cart[$product->id]);
        session()->put('cart', $cart);
        return back()->with('success', 'Item removed from cart.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('shop.cart')->with('error', 'Your cart is empty.');

        $products = [];
        $total    = 0;

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product) {
                $subtotal   = $product->price * $item['quantity'];
                $total     += $subtotal;
                $products[] = ['product' => $product, 'quantity' => $item['quantity'], 'subtotal' => $subtotal];
            }
        }

        return view('shop.checkout', compact('products', 'total'));
    }
}