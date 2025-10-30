<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DefaultAttribute;

class ProductAttributeController extends Controller
{
    public function index()
    {
        return view('admin.product_attribute.create');
    }

    public function manage()
    {
         $allAttributes = DefaultAttribute::all();
        return view('admin.product_attribute.manage', compact('allAttributes'));
    }

    public function createattribute(Request $request)
    {
        // Validate the request data
        $validatedata = $request->validate([
            'attribute_value' => 'unique:default_attributes,attribute_value|required|string|max:255',
        ]);

        // Create a new DefaultAttribute
        DefaultAttribute::create($validatedata);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Default attribute created successfully.');
    }

    public function showattribute($id)
    {
        $attribute = DefaultAttribute::findOrFail($id);
        return view('admin.product_attribute.edit', compact('attribute'));
    }

    public function updateattribute(Request $request, $id)
    {
        // Validate the request data
        $validatedata = $request->validate([
            'attribute_value' => 'unique:default_attributes,attribute_value,'.$id.'|required|string|max:255',
        ]);

        // Find the DefaultAttribute and update it
        $attribute = DefaultAttribute::findOrFail($id);
        $attribute->update($validatedata);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Default attribute updated successfully.');
    }

    public function deleteattribute($id)
    {
        // Find the DefaultAttribute and delete it
        $attribute = DefaultAttribute::findOrFail($id);
        $attribute->delete();

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Default attribute deleted successfully.');
    }
}
