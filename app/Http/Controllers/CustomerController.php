<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $categoryDropdown = Category::limit(8)->get();
        $categories = Category::limit(4)->get();
        $categoryCarousel = Category::all();

        $carouselItems = [];
        $carouselLimit = 8;

        foreach ($categoryCarousel as $category) {

            $categoryProducts = Product::where('category_id', $category->id)
                ->with(['images', 'category'])
                ->latest()
                ->limit(1)
                ->get();

            $products[$category->id] = $categoryProducts;

            if ($categoryProducts->isNotEmpty() && count($carouselItems) < $carouselLimit) {
                $carouselItems[] = $categoryProducts[0];
            }
        }

        $products = [];
        foreach ($categories as $category) {
            $categoryProducts = Product::where('category_id', $category->id)
                ->with('images')
                ->latest()
                ->limit(8)
                ->get();
            $products[$category->id] = $categoryProducts;
        }

        $categoryIds = $categories->pluck('id')->toArray();
        $allProducts = Product::whereNotIn('category_id', $categoryIds)
            ->with(['category', 'images'])
            ->latest()
            ->limit(8)
            ->get();

        return view('customer.product.index', compact('products', 'categories', 'allProducts', 'carouselItems', 'categoryDropdown'));
    }


    public function shop(Request $request)
    {
        $categories = Category::all();

        $search = $request->input('search');
        $sort = $request->input('sort');
        $categorySlug = $request->input('category');

        $category = null;

        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->first();
        }

        $products = Product::with(['category', 'images'])
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->when($category, function ($query) use ($category) {
                return $query->where('category_id', $category->id);
            });

        if ($sort === 'name_asc') {
            $products->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $products->orderBy('name', 'desc');
        } elseif ($sort === 'price_asc') {
            $products->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $products->orderBy('price', 'desc');
        } else {
            $products->latest();
        }

        $products = $products->paginate(12);

        return view('customer.product.shop', compact('products', 'categories'));
    }

    public function shopDetail(Product $product)
    {

        return view('customer.product.shop_detail', compact('product'));
    }
}
