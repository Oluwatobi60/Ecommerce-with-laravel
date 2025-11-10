<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;


class HomeProductFilterComponent extends Component
{

// Selected category ID
    public $selectedCategory = null;
    // List of categories
    public $categories = [];


    // Initialize component with categories
    public function mount()
        {
            $this->categories = Category::all();
        }

        // Filter products by selected category
    public function filterByCategory($category_id)
    {
        // Set the selected category
        $this->selectedCategory = $category_id;
    }

    // Render the component with filtered products
    public function render()
    {
        // Fetch products based on selected category
        $products = Product::when('images')->when($this->selectedCategory, function($query) {
            $query->where('category_id', $this->selectedCategory);
            // If no category is selected, fetch all products
        })->take(12)->get();
        return view('livewire.home-product-filter-component', [
            'products' => $products,
        ]);
    }
}

