<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\product_images;

class ProductSellerController extends Controller
{
    public function index()
    {
        // Get the authenticated user's ID
        $authuserid = Auth::id();

        // Fetch stores associated with the authenticated user
        $stores = Store::where('user_id', $authuserid)->get();
        
        // Pass the stores to the view
        return view('seller.product.create', compact('stores'));
    }

    public function manage()
    {
        // Get the authenticated user's ID
        $authuserid = Auth::id();
        // Fetch products associated with the authenticated seller
        $productsdata = Product::where('seller_id', $authuserid)->get();
        // Fetch all product images
        $imagesdata = product_images::all();
        // Pass the products to the view
        return view('seller.product.manage', compact('productsdata', 'imagesdata'));
    }


    public function storeproduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:products,slug',
        ]);

        // Create the product
        $product = Product::create([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'seller_id' => Auth::id(),
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'store_id' => $request->store_id,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                product_images::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product Added successfully.');
    }

    public function edit($id)
    {
        // Get the authenticated user's ID
        $authuserid = Auth::id();
        // Fetch the product ensuring it belongs to the authenticated seller
        $product = Product::where('id', $id)->where('seller_id', $authuserid)->firstOrFail();
        // Fetch stores associated with the authenticated user
        $stores = Store::where('user_id', $authuserid)->get();
        // Pass the product and stores to the view
        $images = product_images::where('product_id', $id)->get();
        return view('seller.product.edit', compact('product', 'stores', 'images'));
    }


    public function update(Request $request, $id)
    {
        // Get the authenticated user's ID
        $authuserid = Auth::id();
        // Fetch the product ensuring it belongs to the authenticated seller
        $product = Product::where('id', $id)->where('seller_id', $authuserid)->firstOrFail();

        $request->validate([
            'product_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'sku' => 'required|string|unique:products,sku,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'store_id' => 'required|exists:stores,id',
            'regular_price' => 'required|numeric|min:0',
            'discounted_price' => 'nullable|numeric|min:0',
            'tax_rate' => 'nullable|numeric|min:0|max:100',
            'stock_quantity' => 'required|integer|min:0',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'slug' => 'required|string|unique:products,slug,' . $product->id,
        ]);

        // Update the product
        $product->update([
            'product_name' => $request->product_name,
            'description' => $request->description,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'store_id' => $request->store_id,
            'regular_price' => $request->regular_price,
            'discounted_price' => $request->discounted_price,
            'tax_rate' => $request->tax_rate,
            'stock_quantity' => $request->stock_quantity,
            'slug' => $request->slug,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
        ]);

        // Handle image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('product_images', 'public');
                product_images::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_primary' => false,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Product Updated successfully.');
    }

    public function view($id)
    {
        // Get the authenticated user's ID
        $authuserid = Auth::id();
        // Fetch the product ensuring it belongs to the authenticated seller
        $product = Product::where('id', $id)->where('seller_id', $authuserid)->firstOrFail();
        // Fetch stores associated with the authenticated user
        $stores = Store::where('user_id', $authuserid)->get();
        // Pass the product and stores to the view
        $images = product_images::where('product_id', $id)->get();
        return view('seller.product.view', compact('product', 'stores', 'images'));
    }
}