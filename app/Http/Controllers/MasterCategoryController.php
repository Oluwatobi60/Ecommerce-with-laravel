<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class MasterCategoryController extends Controller
{
    public function storecat(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'category_name' => 'unique:categories|max:100|min:5|required',
        ]);

        // Create a new category using the validated data
        Category::create($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category Added successfully!');
    }


    public function showcat($id)
    {
        // Retrieve the category by its ID
        $category_info = Category::findOrFail($id);

        // Return the edit view with the category information
        return view('admin.category.edit', compact('category_info'));
    }

    public function updatecat(Request $request, $id)
    {
      
        // Find the category by its ID
        $category = Category::findOrFail($id);

          // Validate the incoming request data
        $validatedData = $request->validate([
            'category_name' => 'unique:categories,category_name,'.$id.'|max:100|min:5|required',
        ]);

        // Update the category with the validated data
        $category->update($validatedData);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category Updated successfully!');
    }

    public function deletecat($id)
    {
        // Find the category by its ID
        $category = Category::findOrFail($id);

        // Delete the category
        $category->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Category Deleted successfully!');
    }
}
