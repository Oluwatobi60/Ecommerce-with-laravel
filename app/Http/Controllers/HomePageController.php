<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomePageSetting;
use App\Models\Category;
use App\Models\Product;

class HomePageController extends Controller
{
    public function index()
    {

        $homepagesetting = HomePageSetting::with([
            'discountedProduct.images',
            'featuredProduct1.images',
            'featuredProduct2.images', 
            'featuredProduct3.images',
            'featuredProduct4.images',
            'featuredProduct5.images'])->first();
        return view('home.index', compact('homepagesetting'));
    }


    public function cart()
    {
        return view('cart.cart');
    }

    public function showCategoryProducts($category_name)
    {
        // Get the selected category
        $category = Category::where('category_name', $category_name)->firstOrFail();
        
        // Get products for the selected category
        $products = Product::with(['category', 'images'])
                          ->where('category_id', $category->id)
                          ->get();
        
        return view('home.categories', compact('category', 'products'));
    }
}
