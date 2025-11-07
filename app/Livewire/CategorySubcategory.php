<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Subcategory;

class CategorySubcategory extends Component
{

    // Category list
    public $categories=[];

    // Selected category ID
    public $selectedCategory = '';

    // Selected subcategory ID
    public $selectedSubcategory = '';

    // Subcategory list based on selected category
    public $subcategories=[];

    // Initialize component with categories
    public function mount()
    {
        $this->categories = Category::all();
    }

    // Update subcategories when selected category changes
    public function updatedSelectedCategory($categoryId)
    {
        $this->selectedSubcategory = ''; // Reset subcategory selection
        
        if ($categoryId) {
            $this->subcategories = Subcategory::where('category_id', $categoryId)->get();
        } else {
            $this->subcategories = [];
        }
    }

    public function render()
    {
        return view('livewire.category-subcategory');
    }
}
