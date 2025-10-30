<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;

class SubCategoryController extends Controller
{
    public function index()
    {
        // Fetch all categories to show in the subcategory creation form
        $categories = Category::all();
        
        return view('admin.sub_category.create', compact('categories'));
    }

 

    public function manage()
    {
        // Fetch all subcategories to show in the management view
        $subcategories = Subcategory::all();
        return view('admin.sub_category.manage', compact('subcategories'));
    }
}
