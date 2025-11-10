<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearchComponent extends Component
{
    public string $query = '';
    public $results = [];

    public function search()
    {
        $this->results = Product::where('product_name', 'like', '%' . 
        $this->query . '%')->limit(10)->get();
    }

    public function render()
    {
        return view('livewire.product-search-component');
    }
}

