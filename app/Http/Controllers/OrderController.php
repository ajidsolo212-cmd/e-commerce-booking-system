<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'shipping_address'  => 'required|string|max:255',
            'shipping_city'     => 'required|string|max:100',
            'shipping_postcode' => 'required|string|max:10',
            'phone'             => 'required|string|max:20',
            'notes'             => 'nullable|string|max:500',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) return redirect()->route('shop.cart')->with('error', 'Cart is empty.');

        $total = 0;
        $items = [];

        foreach ($cart as $id => $item) {
            $product = Product::find($id);
            if ($product && $product->stock >= $item['quantity']) {
                $subtotal = $product->price * $item['quantity'];
                $total   += $subtotal;
                $items[]  = ['product' => $product, 'quantity' => $item['quantity'], 'unit_price' => $product->price, 'subtotal' => $subtotal];
            }
        }

        if (empty($items)) {
            return redirect()->route('shop.cart')->with('error', 'Some items are out of stock.');
        }

        $order = Order::create([
            'user_id'           => Auth::id(),
            'order_code'        => Order::generateCode(),
            'total_price'       => $total,
            'shipping_address'  => $data['shipping_address'],
            'shipping_city'     => $data['shipping_city'],
            'shipping_postcode' => $data['shipping_postcode'],
            'phone'             => $data['phone'],
            'notes'             => $data['notes'] ?? null,
            'status'            => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item['product']->id,
                'quantity'   => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal'   => $item['subtotal'],
            ]);
            $item['product']->decrement('stock', $item['quantity']);
        }

        session()->forget('cart');
        return redirect()->route('orders.history')
            ->with('success', "Order placed! Your code: {$order->order_code}");
    }

    public function history()
    {
        $orders = Auth::user()->orders()->with('items.product')->latest()->get();
        return view('orders.history', compact('orders'));
    }
}