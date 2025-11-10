@extends('layouts.user')
@section('home')
    @php
        // Get subcategories for the selected category
        $subcategories = isset($category) ? $category->subCategories()->with('products')->get() : collect();
        
        // Get all products for the selected category if no specific subcategory filter
        if(!isset($products)) {
            $products = isset($category) 
                ? App\Models\Product::where('category_id', $category->id)->with(['category', 'subcategory', 'images'])->get()
                : App\Models\Product::with(['category', 'subcategory', 'images'])->get();
        }
    @endphp
    
    <div class="container my-5">
        <div class="row">
            <!-- Sidebar with Subcategory Checkboxes -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fas fa-filter me-2"></i>Filter by Subcategory</h5>
                    </div>
                    <div class="card-body">
                        @if(isset($category))
                            <div class="mb-3">
                                <h6 class="text-muted">
                                    <i class="fas fa-{{ getCategoryIcon($category->category_name) }} me-2"></i>
                                    {{ $category->category_name }}
                                </h6>
                                <hr>
                            </div>
                            
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input subcategory-filter" type="checkbox" value="all" id="subcategoryAll" checked>
                                    <label class="form-check-label fw-bold" for="subcategoryAll">
                                        All Subcategories
                                    </label>
                                </div>
                                <hr>
                            </div>
                            
                            @if($subcategories->count() > 0)
                                @foreach($subcategories as $subcat)
                                    <div class="form-check mb-2">
                                        <input class="form-check-input subcategory-filter" type="checkbox" value="{{ $subcat->id }}" 
                                               id="subcategory{{ $subcat->id }}">
                                        <label class="form-check-label" for="subcategory{{ $subcat->id }}">
                                            {{ $subcat->subcategory_name }}
                                            <span class="badge bg-secondary ms-1">{{ $subcat->products->count() }}</span>
                                        </label>
                                    </div>
                                @endforeach
                                
                                <hr>
                                <button type="button" class="btn btn-sm btn-outline-secondary w-100" onclick="clearFilters()">
                                    <i class="fas fa-times me-1"></i>Clear Filters
                                </button>
                            @else
                                <div class="text-center text-muted py-3">
                                    <i class="fas fa-info-circle"></i>
                                    <p class="mb-0 small">No subcategories available</p>
                                </div>
                            @endif
                        @else
                            <div class="text-center text-muted py-3">
                                <i class="fas fa-info-circle"></i>
                                <p class="mb-0">Please select a category from the navbar</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            
            <!-- Products Display Area -->
            <div class="col-lg-9 col-md-8">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 id="pageTitle">{{ isset($category) ? $category->category_name . ' Products' : 'All Products' }}</h2>
                    <div class="text-muted">
                        <span id="productCount">{{ $products->count() }}</span> Products
                    </div>
                </div>
                
                <!-- Products Grid -->
                <div class="row" id="productsContainer">
                    @if($products->count() > 0)
                        @foreach($products as $product)
                            <div class="col-lg-4 col-md-6 mb-4 product-item" 
                                 data-category="{{ $product->category_id }}" 
                                 data-subcategory="{{ $product->subcategory_id }}">
                                <div class="card h-100 shadow-sm product-card">
                                    <img src="{{ asset('storage/' . ($product->images->first()?->image_path ?? 'placeholder.png')) }}" 
                                         class="card-img-top" alt="{{ $product->product_name }}" 
                                         style="height: 200px; object-fit: cover;">
                                    <div class="card-body">
                                        <span class="badge bg-primary mb-2">{{ $product->category->category_name ?? 'Uncategorized' }}</span>
                                        @if($product->subcategory)
                                            <span class="badge bg-info mb-2">{{ $product->subcategory->subcategory_name }}</span>
                                        @endif
                                        <h5 class="card-title">{{ $product->product_name }}</h5>
                                        <p class="card-text text-muted small">{{ Str::limit($product->description ?? '', 80) }}</p>
                                            <div class="add-cart-wrapper" x-data="{ quantity: 1 }">
                                    <div class="input-group">
                                        <input type="number" min="1" max="{{ $product->stock_quantity }}" x-model="quantity" value="1" class="form-control" style="width: 70px;">
                                        <button type="button" @click="$dispatch('addToCartFromAnywhere', { productId: {{ $product->id }}, quantity: quantity })" class="btn btn-primary">Add to Cart</button>
                                    </div>
                                </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="col-12 text-center py-5">
                            <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                            <h5 class="text-muted">No products found</h5>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const subcategoryCheckboxes = document.querySelectorAll('.subcategory-filter');
            const subcategoryAll = document.getElementById('subcategoryAll');
            const pageTitle = document.getElementById('pageTitle');
            const productCount = document.getElementById('productCount');
            
            if (subcategoryCheckboxes.length > 0) {
                subcategoryCheckboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.value === 'all') {
                            if (this.checked) {
                                subcategoryCheckboxes.forEach(cb => {
                                    if (cb.value !== 'all') cb.checked = false;
                                });
                            }
                        } else {
                            if (subcategoryAll) subcategoryAll.checked = false;
                            const anyChecked = Array.from(subcategoryCheckboxes).some(cb => 
                                cb.value !== 'all' && cb.checked
                            );
                            if (!anyChecked && subcategoryAll) {
                                subcategoryAll.checked = true;
                            }
                        }
                        filterProducts();
                    });
                });
            }
            
            function filterProducts() {
                const selectedSubcategories = [];
                subcategoryCheckboxes.forEach(cb => {
                    if (cb.value !== 'all' && cb.checked) {
                        selectedSubcategories.push(cb.value);
                    }
                });
                
                const allProducts = document.querySelectorAll('.product-item');
                let visibleCount = 0;
                
                if ((subcategoryAll && subcategoryAll.checked) || selectedSubcategories.length === 0) {
                    allProducts.forEach(product => {
                        product.style.display = 'block';
                        visibleCount++;
                    });
                } else {
                    allProducts.forEach(product => {
                        const productSubcategory = product.dataset.subcategory;
                        if (selectedSubcategories.includes(productSubcategory)) {
                            product.style.display = 'block';
                            visibleCount++;
                        } else {
                            product.style.display = 'none';
                        }
                    });
                }
                
                if (productCount) {
                    productCount.textContent = visibleCount;
                }
            }
        });
        
        function clearFilters() {
            const subcategoryCheckboxes = document.querySelectorAll('.subcategory-filter');
            subcategoryCheckboxes.forEach(cb => cb.checked = false);
            const subcategoryAll = document.getElementById('subcategoryAll');
            if (subcategoryAll) subcategoryAll.checked = true;
            document.querySelectorAll('.product-item').forEach(product => {
                product.style.display = 'block';
            });
            const productCount = document.getElementById('productCount');
            if (productCount) {
                productCount.textContent = document.querySelectorAll('.product-item').length;
            }
        }
    </script>
    
    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15) !important;
        }
    </style>
@endsection
