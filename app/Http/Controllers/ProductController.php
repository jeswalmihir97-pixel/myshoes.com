<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function showadp(){
        return view('adp');
    }
    public function index()
    {
        $products = Product::all(); // Fetch all products from the database
        return view('home', compact('products')); // Pass products to view
    }

    public function store(Request $request)
    {
        $request->validate([
            'pn' => 'required',
            'image' => 'required|image',
            'pr' => 'required|numeric',
            'qty' => 'required|numeric'
        ]);

        // Store image in public/uploads folder
        $imageName = time() . '.' . $request->image->extension(); // Generate unique name
        $request->image->move(public_path('uploads'), $imageName); // Move image to public/uploads

        // Save product details in the database
        Product::create([
            'name' => $request->pn,
            'image' => 'uploads/' . $imageName, // Save relative path
            'price' => $request->pr,
            'quantity' => $request->qty,
        ]);

        return redirect()->route('adp')->with('success', 'Product Added Successfully');
    }
    public function adminHome()
    {
        // 1️⃣ Fetch total number of orders from the order_items table
        $totalOrders = OrderItem::count();

        // 2️⃣ Calculate available stock (Total product quantity - Total sold quantity)
        $availableStock = Product::sum('quantity') - OrderItem::sum('quantity');

        // 3️⃣ Count total available products from the products table
        $availableProducts = Product::count();

        return view('admin_home', compact('totalOrders', 'availableStock', 'availableProducts'));
    }



 
}
