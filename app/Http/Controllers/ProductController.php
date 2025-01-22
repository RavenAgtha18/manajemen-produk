<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        log::debug($products);
        return view("pages.product.product", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view("pages.product.create", compact("categories"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        log::debug($request->all());
        $validate = $request->validate([
            "category_id"=>"required",
            "name"=> "required",
            "description"=> "nullable",
            "price"=> "required",
            "stock"=>"required",
            "image_file"=> "nullable",
        ]) ;
        Product::create([
            "category_id"=> $request->category_id,
            "name"=> $request->name,
            "description"=> $request->description,
            "price"=> $request->price,
            "stock_quantity"=> $request->stock,
            "image"=> $request->image_file,
        ]);
        return redirect()->route("product")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view("pages.product.edit",  compact("categories","product"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "category_id" => "required",
            "name" => "required",
            "description" => "nullable",
            "price" => "required|numeric", 
            "stock" => "required|integer", 
            "image_file" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048", 
        ]);

        $product = Product::findOrFail($id);
    
        $product->update([
            "category_id" => $validatedData['category_id'],
            "name" => $validatedData['name'],
            "description" => $validatedData['description'],
            "price" => $validatedData['price'],
            "stock_quantity" => $validatedData['stock'],
            "image" => $validatedData['image_file'],
        ]);
    
        return redirect()->route("product")->with("success", "Product updated successfully.");
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = Product::findOrFail($id); 
    $product->delete();

    return redirect()->route('product')->with('success', 'Product deleted successfully.');
}
}
