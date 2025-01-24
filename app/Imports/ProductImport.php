<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Log;

class ProductImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
{
    Log::debug('Row data:', $row);
    $category = Category::where('name', $row['category_name'])->first();
    Log::debug('Category found:', $category ? $category->toArray() : null);

    if (!$category) {
        Log::warning('Category not found for name: ' . $row['category_name']);
        return null; 
    }

    $product = new Product([
        'category_id' => $category->id,
        'name' => $row['product_name'], 
        'description' => $row['description'],
        'price' => $row['price'],
        'stock_quantity' => $row['stock'],
    ]);

    $product->save(); 

    return $product; 
}
}