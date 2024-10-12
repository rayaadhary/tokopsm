<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $product = Product::count();
        $category = Category::count();
        return view('admin.dashboard', compact('product', 'category'));
    }
}
