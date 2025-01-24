<?php

namespace App\Exports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CategoryExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Category::all()->map(function ($category) {
            return [
                'Category Name' => $category->name, 
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
        ];
    }
}