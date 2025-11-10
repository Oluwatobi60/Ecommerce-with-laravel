@if($isCartPage)
    <!-- Full Cart Page -->
    <div>
        <section class="cart-container py-5">
            <div class="container">
                <div class="cart-header mb-4">
                    <h1>Shopping Cart</h1>
                </div>
                
                @forelse ($cartItems as $productId => $item)
                    <div class="cart-item d-flex align-items-center mb-4 p-3 border rounded shadow-sm">
                        <div class="cart-item-image me-4">
                            <img src="{{ asset('storage/' . ($item['image'] ?? 'placeholder.png')) }}" alt="{{ $item['product_name'] }}" style="width: 100px; height: 100px; object-fit: cover;" class="rounded">
                        </div>
                        <div class="cart-item-details flex-grow-1">
                            <h4 class="mb-2">{{ $item['product_name'] }}</h4>
                            <p class="mb-1 text-muted">Price: ${{ number_format($item['price'], 2) }}</p>
                            <div class="d-flex align-items-center gap-2 mb-2">
                                <button wire:click="decreseQquantity({{ $productId }})" class="btn btn-sm btn-outline-secondary">-</button>
                                <span class="px-3">{{ $item['quantity'] }}</span>
                                <button wire:click="increaseQuantity({{ $productId }})" class="btn btn-sm btn-outline-secondary">+</button>
                            </div>
                            <p class="mb-1 fw-bold">Total: ${{ number_format($item['price'] * $item['quantity'], 2) }}</p>
                        </div>
                        <div class="cart-item-actions">
                            <button class="btn btn-danger" wire:click="removeItem({{ $productId }})">
                                <i class="fas fa-trash"></i> Remove
                            </button>
                        </div>
                    </div>  
                    
                @empty
                    <div class="text-center py-5">
                        <i class="fas fa-shopping-cart fa-4x text-muted mb-3"></i>
                        <p class="text-muted">Your cart is empty.</p>
                        <a href="{{ route('home') }}" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
                @endforelse

                @if(count($cartItems) > 0)
                <div class="cart-summary mt-4 p-4 border rounded shadow-sm bg-light">
                    <h3 class="mb-3">Cart Summary</h3>
                    <p class="mb-2"><strong>Total Items:</strong> {{ collect($cartItems)->sum('quantity') }}</p>
                    <p class="mb-3"><strong>Total Amount:</strong> ${{ number_format($total, 2) }}</p>
                    <button class="btn btn-primary btn-lg w-100">
                        <i class="fas fa-shopping-bag me-2"></i>Proceed to Checkout
                    </button>
                </div>
                @endif
            </div>
        </section>
    </div>
@else
    <!-- Cart Icon Link -->
    <a href="{{ route('cart.add') }}" class="icon-btn">
        🛒
        <span class="badge cart-count">{{ count($cartItems) }}</span>
    </a>
@endif