<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\StockMovement;


class StockController extends Controller
{
    public function index(Request $request)
    {
        $stockMovements = StockMovement::with('product')->paginate(10); 
        return view("pages.stock.index", compact('stockMovements'));
    }
    public function create()
    { 
        $products = Product::all();
        return view("pages.stock.create", compact('products'));
    }
    public function store(Request $request)
    {
    
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'change_type' => 'required|in:increase,decrease',
        ]);

        $product = Product::find($request->product_id);

        if ($request->change_type === 'increase') {
            $product->stock_quantity += $request->quantity; 
        } elseif ($request->change_type === 'decrease') {
            if ($product->stock_quantity < $request->quantity) {
                return redirect()->back()->withErrors(['quantity' => 'Stock cannot be negative.']);
            }
            $product->stock_quantity -= $request->quantity; 
        }

        $product->save();

        StockMovement::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'change_type' => $request->change_type,
        ]);

        return redirect()->route('stock')->with('success', 'Stock movement added successfully!');
    }
}
