<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class GlobalCartButton extends Component
{

    protected $listeners = ['addToCartFromAnywhere' => 'addToCart'];
    public function addToCart($productId, $quantity=1)
    { 
        // Find the product by ID
        $product = Product::findOrFail($productId);
        // Add product to cart (assuming a cart helper function exists)
        $cart = session()->get('cart', []);

        // If the product is already in the cart, increase the quantity
        if(isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                "product_name" => $product->product_name,
                "price" => $product->regular_price,
                "quantity" => $quantity,
                "image" => $product->images->first()?->image_path ?? 'placeholder.png'
            ];
        }   

        // Save the updated cart back to the session
        session()->put('cart', $cart);

        // Optionally, you can dispatch a browser event to update cart UI
        $this->dispatch('cartUpdated');

        // Optionally, you can emit an event or flash a message
        $this->dispatch('notify', title:'Added to Cart', type:'success');

    }


    public function render()
    {
        return view('livewire.global-cart-button');
    }
}
