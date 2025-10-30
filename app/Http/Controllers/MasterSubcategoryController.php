<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subcategory;

class MasterSubcategoryController extends Controller
{
    public function storesubcat(Request $request)
    {
        // Validate the incoming request data
        $validatedata = $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Create a new subcategory
        Subcategory::create($validatedata);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Subcategory created successfully!');
    }

    public function showsubcat($id)
    {
        // Retrieve the subcategory by its ID
        $subcategory_info = Subcategory::findOrFail($id);

        // Return the edit view with the subcategory information
        return view('admin.sub_category.edit', compact('subcategory_info'));
    }

    public function updatesubcat(Request $request, $id)
    {
        // Validate the incoming request data
        $validatedata = $request->validate([
            'subcategory_name' => 'required|string|max:255',
        ]);

        // Find the subcategory and update its information
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->update($validatedata);

        // Redirect back with a success message
        return redirect()->route('admin.sub_category.manage')->with('success', 'Subcategory updated successfully!');
    }

    public function deletesubcat($id)
    {
        // Find the subcategory and delete it
        $subcategory = Subcategory::findOrFail($id);
        $subcategory->delete();

        // Redirect back with a success message
        return redirect()->route('admin.sub_category.manage')->with('success', 'Subcategory deleted successfully!');
    }
}
