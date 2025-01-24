<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category') 
            ->get()
            ->map(function ($product) {
                return [
                    'Category Name' => $product->category->name, 
                    'Product Name' => $product->name,
                    'Description' => $product->description,
                    'Price' => $product->price,
                    'Stock' => $product->stock_quantity,
                ];
            });
    }

    /**
    *
    * @return array
    */
    public function headings(): array
    {
        return [
            'Category Name',
            'Product Name',
            'Description',
            'Price',
            'Stock',
        ];
    }
}