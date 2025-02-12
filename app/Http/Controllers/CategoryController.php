<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Exports\CategoryExport;
use Maatwebsite\Excel\Facades\Excel;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return view("pages.category.index", compact("categories"));
    }
    public function export()
    {
        return Excel::download(new CategoryExport, 'category.xlsx');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.category.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            "category"=> "required",
        ]) ;
        Category::create([
            "name"=> $request->category,
        ]);
        return redirect()->route("category")->with("success","");
    }

    /**
     * Display the specified resource.
     */
    public function show($id )
    {
        $category = Category::findOrFail($id);
        session()->flash('category', $category); 
        return redirect()->route('category'); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::findOrFail($id);
        return view("pages.category.edit",  compact( "categories"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            "category" => "required",
        ]);

        $category = Category::findOrFail($id);
    
        $category->update([
            "name" => $validatedData['category'],
        ]);
    
        return redirect()->route("category")->with("success", "Category updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id); 
        $categories->delete();
    
        return redirect()->route('category')->with('success', 'Category deleted successfully.');
    }
}
