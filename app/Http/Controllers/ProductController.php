<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->paginate(10);
        return view("pages.product.product", compact("products"));
    }

    public function create()
    {
        $categories = Category::all();
        return view("pages.product.create", compact("categories"));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "category_id" => "required",
            "name" => "required",
            "description" => "nullable",
            "price" => "required|numeric",
            "stock" => "required|integer",
            "image_file" => "nullable|image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);
    
        $imagePath = null;
        if ($request->hasFile('image_file')) {
            $image = $request->file('image_file');
            
            $originalName = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
            $extension = $image->getClientOriginalExtension();
            
            $newFileName = $originalName . '_' . time() . '.' . $extension;
            
            $imagePath = $image->storeAs('product_images', $newFileName, 'public');
        }
    Log::debug( $imagePath);
        Product::create([
            "category_id" => $validatedData['category_id'],
            "name" => $validatedData['name'],
            "description" => $validatedData['description'],
            "price" => $validatedData['price'],
            "stock_quantity" => $validatedData['stock'],
            "image" => $imagePath,
        ]);
    
        return redirect()->route("product")->with("success", "Product added successfully");
    }
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        log::debug($product);
        return view('pages.product.show', compact('product'));
    }

    public function edit(string $id)
    {
        $categories = Category::all();
        $product = Product::findOrFail($id);
        return view("pages.product.edit", compact("categories", "product"));
    }

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

        if ($request->hasFile('image_file')) {

            if ($product->image_file) {
                Storage::disk('public')->delete($product->image_file);
            }


            $imagePath = $request->file('image_file')->store('product_images', 'public');
        } else {
  
            $imagePath = $product->image_file;
        }

        $product->update([
            "category_id" => $validatedData['category_id'],
            "name" => $validatedData['name'],
            "description" => $validatedData['description'],
            "price" => $validatedData['price'],
            "stock_quantity" => $validatedData['stock'],
            "image_file" => $imagePath,
        ]);

        return redirect()->route("product")->with("success", "Product updated successfully");
    }

    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        
        if ($product->image_file) {
            Storage::disk('public')->delete($product->image_file);
        }

        $product->delete();

        return redirect()->route('product')->with('success', 'Product deleted successfully');
    }
}