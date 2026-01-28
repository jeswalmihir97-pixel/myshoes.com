<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem; // Import OrderItem model
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Show cart page
    public function index()
    {
        return view('cart');
    }

    // Add Product to Cart
    public function addToCart(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "price" => $product->price,
                "quantity" => $request->quantity ?? 1,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->route('cart.show')->with('success', 'Product added to cart');
    }

    // Show Cart Items
    public function showCart()
    {
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    // Remove Item from Cart
    public function removeFromCart($id)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }
        return redirect()->route('cart.show')->with('success', 'Product removed from cart');
    }

    // Update Cart Quantity
    public function updateCart(Request $request, $id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] = $request->quantity;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Cart updated successfully');
    }

    // Checkout Page
    public function checkout()
    {
        $user = User::where('username', session('username'))->first();
        return view('checkout', compact('user'));
    }

    // Process Checkout & Store Order
    public function processCheckout(Request $request)
    {
        $user = User::where('username', session('username'))->first();
        $cart = session('cart');

        if (!$cart || count($cart) == 0) {
            return redirect()->route('cart.show')->with('error', 'Cart is empty.');
        }

        // Create Order
        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name ?? $user->name,
            'email' => $request->email ?? $user->email,
            'phone' => $request->phone ?? $user->phone,
            'address' => $request->address,
            'payment_method' => $request->payment,
            'total' => array_sum(array_map(fn($item) => $item['price'] * $item['quantity'], $cart)),
        ]);

        // Store Order Items
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'name' => $item['name'],
                'price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image']
            ]);
        }

        // Clear Cart
        session()->forget('cart');

        return redirect()->route('invoice.generate', $order->id);
    }

    // Generate Invoice
    public function generateInvoice($order_id)
    {
        $order = Order::findOrFail($order_id);
        $orderItems = OrderItem::where('order_id', $order->id)->get();

        return view('invoice', compact('order', 'orderItems'));
    }
    public function mybooking()
    {
        $user = User::where('username', session('username'))->first();
        $orders = Order::where('user_id', $user->id)->with('items')->get(); // Fetch orders with order items

        return view('mybooking', compact('orders'));
    }

}
