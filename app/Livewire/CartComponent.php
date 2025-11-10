<?php

namespace App\Livewire;

use Livewire\Component;

class CartComponent extends Component
{
    // Indicate if the component is rendered on the cart page
    public $isCartPage = false;

    // Listen for cart updates and refresh the component
    protected $listeners = ['cartUpdated' => '$refresh'];
    // Retrieve cart from session
    public function getCartProperty()
    {
        // Return the cart array from session or an empty array if not set
        return session()->get('cart', []);
    }


    // Increase quantity of a product in the cart
    public function increaseQuantity($productId)
    {
        // Get the current cart from session
        $cart = $this->cart;
        if(isset($cart[$productId])){
            $cart[$productId]['quantity'] += 1;
            session()->put('cart',$cart);
            $this->dispatch('notify', title:'Item Increased', type:'success');
            $this->dispatch('cartUpdated');
        }
    }

    public function decreseQquantity($productId)
    {
        // Get the current cart from session
        $cart = $this->cart;
        if(isset($cart[$productId])){
            if($cart[$productId]['quantity'] > 1){
                $cart[$productId]['quantity'] -= 1;
                session()->put('cart',$cart);
                $this->dispatch('notify', title:'Item Decreased', type:'info');
                $this->dispatch('cartUpdated');
            }else{
                $this->removeItem($productId);
                 $this->dispatch('cartUpdated');
            }
        }
    }

    public function removeItem($productId)
    {
        $cart= $this->cart;
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->dispatch('notify', title:'Item Removed', type:'warning');
        /* $this->dispatch('cartUpdated'); */
    }

    public function getTotalProperty()
    {
        return collect($this->cart)->sum(fn($item)=> $item['price'] * $item['quantity']);
    }

    public function render()
    {
        return view('livewire.cart-component', data:[
            'cartItems' => $this->cart,
            'total' => $this->total,
        ]);
    }
}

