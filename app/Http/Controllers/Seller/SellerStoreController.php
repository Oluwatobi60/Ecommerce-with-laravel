<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class SellerStoreController extends Controller
{
     public function index()
    {
        return view('seller.store.create');
    }

    public function manage()
    {
        $userid = Auth::user()->id;
        $storedata = Store::where('user_id', $userid)->get();
        return view('seller.store.manage', compact('storedata'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'store_name' => 'unique:stores|string|max:100|min:3',
            'slug' => 'required|unique:stores',
            'details' => 'required',
        ]);

       
        // Create a new store record in the database (assuming a Store model exists)
        Store::create([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
            'user_id' => Auth::user()->id,
         ]);

        // Redirect to the store management page with a success message
        return redirect()->back()->with('success', 'Store created successfully!');
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        return view('seller.store.edit', compact('store'));
    }

    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $request->validate([
             'store_name' => 'unique:stores|string|max:100|min:3',
            'slug' => 'required|unique:stores',
            'details' => 'required',
        ]);

        // Find the store by ID and update its details
        $store = Store::findOrFail($id);
        $store->update([
            'store_name' => $request->store_name,
            'slug' => $request->slug,
            'details' => $request->details,
        ]);

        // Redirect to the store management page with a success message
        return redirect()->back()->with('success', 'Store updated successfully!');
    }

    public function delete($id)
    {
        // Find the store by ID and delete it
        $store = Store::findOrFail($id);
        $store->delete();

        // Redirect to the store management page with a success message
        return redirect()->back()->with('success', 'Store deleted successfully!');
    }
}
