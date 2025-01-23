<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $productCount=Product::count();
        $categoryCount=Category::count();
        return view("dashboard", compact("productCount","categoryCount"));
    }
}
