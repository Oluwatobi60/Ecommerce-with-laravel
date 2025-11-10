<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\HomePageSetting;

class AdminMainController extends Controller
{
    public function index()
    {
        return view('admin.admin');
    }


    // Display admin settings page
    public function settings()
    {
        // Fetch all products for the settings page
        $products = Product::all();
        // Fetch the first settings record or create a new instance if none exists
        // This ensures that the view always has a HomePageSetting instance to work with
        $homepagesetting = HomePageSetting::first() ?? new HomePageSetting();
        return view('admin.settings', compact('products', 'homepagesetting'));
    }


    // Update home page settings
    public function updatehomepagesetting(Request $request)
    {

        // Validate the incoming request data
        $request->validate([
            'discounted_product_id' => 'required|exists:products,id',
            'discount_percent' => 'required|numeric|min:0|max:100',
            'discount_heading' => 'required|string|max:255',
            'discount_subheading' => 'required|string|max:255',
            'featured_product_1_id' => 'required|exists:products,id',
            'featured_product_2_id' => 'required|exists:products,id',
            'featured_product_3_id' => 'required|exists:products,id',
            'featured_product_4_id' => 'required|exists:products,id',
            'featured_product_5_id' => 'required|exists:products,id',
        ]);

        // Retrieve the existing settings or create a new instance
        $homepagesetting = HomePageSetting::first() ?? new HomePageSetting();
        // Update the settings with the validated data
        $homepagesetting->fill($request->all());
        // Save the updated settings to the database
        $homepagesetting->save();

        // Redirect back to the settings page with a success message
        return redirect()->route('admin.settings')->with('success', 'Home page settings updated successfully.');
    }


    // Manage users
    public function manage_user()
    {
        return view('admin.manage.user');   
    }


    // Manage stores
    public function manage_store()
    {
        return view('admin.manage.store');  
    }


    // View cart history
    public function cart_history()
    {
        return view('admin.cart.history');
    }


    // View order history
    public function order_history()
    {
        return view('admin.order.history');
    }
    
}
