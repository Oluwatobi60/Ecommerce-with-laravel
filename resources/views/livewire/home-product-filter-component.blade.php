<div>
   <!-- Categories Section -->
    <section class="categories py-4 bg-light" id="categories">
        <div class="container">
            <!-- Section Header -->
            <div class="text-center mb-4">
                <h2 class="h4 fw-bold mb-3">Shop by Category</h2>
            </div>

            <!-- Category Buttons -->
            <div class="d-flex flex-wrap justify-content-center gap-2">
                <!-- All Products Button -->
                <button 
                    wire:click="filterByCategory(null)" 
                    class="btn {{ $selectedCategory === null ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                    <i class="fas fa-th me-2"></i>All Products
                </button>

                @foreach ($categories as $category)
                <button 
                    wire:click="filterByCategory({{ $category->id }})" 
                    class="btn {{ $selectedCategory === $category->id ? 'btn-primary' : 'btn-outline-primary' }} rounded-pill">
                    <i class="fas fa-{{ getCategoryIcon($category->category_name) }} me-2"></i>
                    {{ $category->category_name }}
                </button>
                @endforeach
            </div>
        </div>
    </section>


         <!-- Featured Product 6 -->
    <section class="products" id="deals">
        <div class="container">
            <h2 class="section-title">Featured Products</h2>
            <div class="row">
                @forelse ( $products as $product )
                    <!-- Product Card -->
                    <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                        <div class="card product-card h-100" data-product-id="{{ $product->id }}">
                            <img src="{{ asset('storage/'.$product->images->first()?->image_path ?? 'placeholder.png') }}" alt="Premium Headphones" class="product-image card-img-top">
                            <div class="product-info card-body">
                                <div class="product-category">{{ $product->category->category_name ?? 'Uncategorized' }}</div>
                                <h3 class="product-title">{{ $product->product_name }}</h3>
                                <div class="product-rating">⭐⭐⭐⭐⭐ (128)</div>
                                <div class="product-price">
                                    <span class="price-current">${{ number_format($product->regular_price, 2) }}</span>
                                   <span class="price-old">${{ number_format($product->discounted_price, 2) }}</span> 
                                </div>
                                <div class="add-cart-wrapper" x-data="{ quantity: 1 }">
                                    <div class="input-group">
                                        <input type="number" min="1" max="{{ $product->stock_quantity }}" x-model="quantity" value="1" class="form-control" style="width: 70px;">
                                        <button type="button" @click="$dispatch('addToCartFromAnywhere', { productId: {{ $product->id }}, quantity: quantity })" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center">
                        <h5>No product found for this category</h5>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
