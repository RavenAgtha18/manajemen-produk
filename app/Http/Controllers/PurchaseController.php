<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::with('product')->paginate(10);
        return view('pages.purchase.index', compact('purchases'));
    }

        public function create()
    {

   
        
        $products = Product::all();
        return view('pages.purchase.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;

        Purchase::create([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);
        session()->forget(['product_id', 'quantity', 'total_price']);
        return redirect()->route('purchase')->with('success', 'Purchase recorded successfully!');
    }
    public function calculate(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);
    
        $product = Product::find($request->product_id);
        $totalPrice = $product->price * $request->quantity;
    
        session([
            'product_id' => $product->id,
            'quantity' => $request->quantity,
            'total_price' => $totalPrice,
        ]);
    
        return redirect()->route('purchase.create')->with('success', 'Total price calculated successfully.');
    }
}