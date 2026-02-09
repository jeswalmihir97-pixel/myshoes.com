<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index()
    {
        // Fetch all products
        $products = Product::all();

        // Calculate stock for each product
        foreach ($products as $product) {
            // Get the total quantity sold from order_items table
            $soldQuantity = OrderItem::where('product_id', $product->id)->sum('quantity');

            // Ensure product has stock column
            $product->sold_quantity = $soldQuantity; // Total sold items
            $product->remaining_stock = max($product->quantity - $soldQuantity, 0); // Ensure it doesn't go negative
        }

        return view('stocks', compact('products'));
    }

    public function updateStock($id, $new_stock)
    {
        // Fetch product by ID
        $product = Product::findOrFail($id);

        // Ensure the new stock value is numeric and non-negative
        if (is_numeric($new_stock) && $new_stock >= 0) {
            $product->quantity  = $new_stock;
            $product->save();
            
            return redirect()->route('stocks')->with('success', 'Stock updated successfully!');
        }

        return redirect()->route('stocks')->with('error', 'Invalid stock value.');
    }

    
    public function removeProduct($id)
    {
         $product = Product::findOrFail($id);
         $product->delete();

        return redirect()->route('stocks')->with('success', 'Product removed successfully!');
    }
}
