@extends('seller.layouts.layout')
@section('seller_page_title')
View Product - Seller Panel
@endsection
@section('seller_layout')
    <div class="container-fluid">
        <!-- Header Section -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-gradient-primary text-white">
                        <h4 class="card-title mb-0 d-flex align-items-center">
                            <i class="fas fa-eye me-2"></i>
                            Product Details
                        </h4>
                    </div>
                </div>
            </div>
        </div>

        @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                     @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
 
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Product Card -->
        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-light border-bottom-0">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-box me-2"></i>
                            {{ $product->product_name }}
                        </h5>
                        <span class="badge bg-success">In Stock: {{ $product->stock_quantity }}</span>
                    </div>
                    <div class="card-body">
                        <!-- Product Description -->
                        <div class="mb-4">
                            <h6 class="text-muted mb-2">
                                <i class="fas fa-align-left me-1"></i>
                                Description
                            </h6>
                            <p class="card-text">{{ $product->description ?: 'No description available' }}</p>
                        </div>

                        <!-- Product Details Grid -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small">SKU</label>
                                    <p class="fw-bold mb-1">{{ $product->sku }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Category</label>
                                    <p class="fw-bold mb-1">
                                        <span class="badge bg-info">{{ $product->category->category_name ?? 'N/A' }}</span>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Subcategory</label>
                                    <p class="fw-bold mb-1">
                                        <span class="badge bg-secondary">{{ $product->subcategory->subcategory_name ?? 'N/A' }}</span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="text-muted small">Slug</label>
                                    <p class="fw-bold mb-1 text-break">{{ $product->slug }}</p>
                                </div>
                                <div class="mb-3">
                                    <label class="text-muted small">Tax Rate</label>
                                    <p class="fw-bold mb-1">{{ $product->tax_rate ?? '0' }}%</p>
                                </div>
                            </div>
                        </div>

                        <!-- SEO Information -->
                        <div class="mt-4 pt-3 border-top">
                            <h6 class="text-muted mb-3">
                                <i class="fas fa-search me-1"></i>
                                SEO Information
                            </h6>
                            <div class="mb-2">
                                <label class="text-muted small">Meta Title</label>
                                <p class="mb-1">{{ $product->meta_title ?: 'Not set' }}</p>
                            </div>
                            <div class="mb-2">
                                <label class="text-muted small">Meta Description</label>
                                <p class="mb-1">{{ $product->meta_description ?: 'Not set' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pricing & Stock Sidebar -->
            <div class="col-lg-4">
                <div class="card shadow-lg border-0 mb-4">
                    <div class="card-header bg-success text-white">
                        <h6 class="card-title mb-0">
                            <i class="fas fa-dollar-sign me-2"></i>
                            Pricing & Stock
                        </h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-3">
                            @if($product->discounted_price && $product->discounted_price < $product->regular_price)
                                <div class="mb-2">
                                    <span class="text-muted text-decoration-line-through fs-5">${{ number_format($product->regular_price, 2) }}</span>
                                </div>
                                <div class="mb-2">
                                    <span class="text-success fw-bold fs-3">${{ number_format($product->discounted_price, 2) }}</span>
                                </div>
                                <div>
                                    <span class="badge bg-danger">
                                        {{ round((($product->regular_price - $product->discounted_price) / $product->regular_price) * 100) }}% OFF
                                    </span>
                                </div>
                            @else
                                <div class="mb-2">
                                    <span class="text-primary fw-bold fs-3">${{ number_format($product->regular_price, 2) }}</span>
                                </div>
                            @endif
                        </div>
                        
                        <hr>
                        
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Stock Quantity:</span>
                            <span class="fw-bold {{ $product->stock_quantity > 10 ? 'text-success' : ($product->stock_quantity > 0 ? 'text-warning' : 'text-danger') }}">
                                {{ $product->stock_quantity }}
                            </span>
                        </div>
                        
                        <div class="progress mb-3" style="height: 8px;">
                            <div class="progress-bar {{ $product->stock_quantity > 10 ? 'bg-success' : ($product->stock_quantity > 0 ? 'bg-warning' : 'bg-danger') }}" 
                                 style="width: {{ min(($product->stock_quantity / 50) * 100, 100) }}%"></div>
                        </div>
                        
                        <div class="d-grid gap-2">
                           
                            <a href="{{ route('vendor.product.manage') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-1"></i>
                                Back to Products
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Images Section -->
        @if($product->images && $product->images->count() > 0)
        <div class="row">
            <div class="col-12">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-light">
                        <h5 class="card-title mb-0 text-primary">
                            <i class="fas fa-images me-2"></i>
                            Product Images ({{ $product->images->count() }})
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-4">
                            @foreach($product->images as $image)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card h-100 shadow-sm border-0 position-relative overflow-hidden">
                                    <div class="image-wrapper position-relative">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" 
                                             class="card-img-top" 
                                             style="height: 200px; object-fit: cover; transition: transform 0.3s ease;" 
                                             alt="Product Image {{ $loop->iteration }}"
                                             onmouseover="this.style.transform='scale(1.05)'"
                                             onmouseout="this.style.transform='scale(1)'">
                                        <div class="position-absolute top-0 end-0 m-2">
                                            <span class="badge bg-dark bg-opacity-75">{{ $loop->iteration }}</span>
                                        </div>
                                    </div>
                                    <div class="card-body p-2 text-center">
                                        <small class="text-muted">Image {{ $loop->iteration }}</small>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @else
        @endif
    </div>

    <style>
        .bg-gradient-primary {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
        
        .card {
            transition: transform 0.2s ease-in-out;
        }
        
        .card:hover {
            transform: translateY(-2px);
        }
        
        .image-wrapper {
            overflow: hidden;
            border-radius: 0.375rem 0.375rem 0 0;
        }
        
        .progress {
            border-radius: 10px;
        }
        
        .badge {
            font-size: 0.75em;
        }
    </style>
@endsection