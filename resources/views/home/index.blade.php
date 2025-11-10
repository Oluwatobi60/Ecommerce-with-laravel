@extends('layouts.user')
@section('home')
 <!-- Discounted Products Banner -->
    <section class="discounted-banner py-5">
        <div class="container">
            <div class="discount-header mb-4">
                <div class="discount-title">
                    <span class="discount-icon">💰</span>
                    <h2>{{ $homepagesetting->discount_heading }} {{$homepagesetting->discount_percent}}%</h2>
                </div>
                <a href="products.html" class="view-all-link">View All →</a>
            </div>
            
            <div class="row g-3">
                <!-- Large Featured Product (Left Side) -->
                <div class="col-lg-8 col-md-7">
                    <div class="discount-card-large position-relative overflow-hidden rounded-3 shadow-lg h-100">
                        <div class="discount-badge-large position-absolute top-0 start-0 m-3 bg-danger text-white px-4 py-2 rounded-pill fs-5 fw-bold">
                            {{$homepagesetting->discount_percent}}% OFF
                        </div>
                            <img src="{{ asset('storage/' . $homepagesetting->featuredProduct1->images->first()->image_path) }}" 
                                 alt="{{ $homepagesetting->featuredProduct1->product_name }}" 
                                 class="w-100 discount-image-large" 
                                 style="height: 500px; object-fit: cover;">
                      
                        <div class="discount-info-overlay position-absolute bottom-0 start-0 w-100 p-4 bg-dark bg-opacity-75 text-white">
                            <h3 class="mb-2">{{ $homepagesetting->featuredProduct1->product_name }}</h3>
                            <div class="discount-price mb-3">
                                <span class="badge bg-danger">{{ $homepagesetting->discount_subheading }}</span>
                                <span class="new-price fs-3 fw-bold text-warning me-3">${{ $homepagesetting->featuredProduct1->discounted_price }}</span>
                                <span class="old-price text-decoration-line-through text-light">${{ $homepagesetting->featuredProduct1->regular_price }}</span>
                            </div>
                            <button class="btn btn-warning btn-lg px-4">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Two Smaller Products (Right Side - Vertical Stack) -->
                <div class="col-lg-4 col-md-5">
                    <div class="d-flex flex-column gap-3 h-100">
                        <!-- Second Product (Top) -->
                        <div class="discount-card-small position-relative overflow-hidden rounded-3 shadow flex-fill">
                            <div class="discount-badge position-absolute top-0 start-0 m-2 bg-danger text-white px-3 py-1 rounded-pill fw-bold">
                                {{$homepagesetting->discount_percent}}%
                            </div>
                                <img src="{{ asset('storage/' . $homepagesetting->featuredProduct2->images->first()->image_path) }}" 
                                     alt="{{ $homepagesetting->featuredProduct2->product_name }}" 
                                     class="w-100" 
                                     style="height: 180px; object-fit: cover;">
        
                            <div class="p-3 bg-white">
                                <h5 class="mb-2 text-truncate">{{ $homepagesetting->featuredProduct2->product_name }}</h5>
                                <div class="discount-price mb-2">
                                    <span class="new-price fw-bold text-danger fs-5">${{ $homepagesetting->featuredProduct2->discounted_price }}</span>
                                    <span class="old-price text-decoration-line-through text-muted ms-2">${{ $homepagesetting->featuredProduct2->regular_price }}</span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-cart-plus me-1"></i>Quick Add
                                </button>
                            </div>
                        </div>

                        <!-- Third Product (Bottom) -->
                        <div class="discount-card-small position-relative overflow-hidden rounded-3 shadow flex-fill">
                            <div class="discount-badge position-absolute top-0 start-0 m-2 bg-danger text-white px-3 py-1 rounded-pill fw-bold">
                                {{$homepagesetting->discount_percent}}%
                            </div>
                           
                                <img src="{{ asset('storage/' . $homepagesetting->featuredProduct3->images->first()->image_path) }}" 
                                     alt="{{ $homepagesetting->featuredProduct3->product_name }}" 
                                     class="w-100" 
                                     style="height: 180px; object-fit: cover;">
                           
                            <div class="p-3 bg-white">
                                <h5 class="mb-2 text-truncate">{{ $homepagesetting->featuredProduct3->product_name }}</h5>
                                <div class="discount-price mb-2">
                                    <span class="new-price fw-bold text-danger fs-5">${{ $homepagesetting->featuredProduct3->discounted_price }}</span>
                                    <span class="old-price text-decoration-line-through text-muted ms-2">${{ $homepagesetting->featuredProduct3->regular_price }}</span>
                                </div>
                                <button class="btn btn-outline-primary btn-sm w-100">
                                    <i class="fas fa-cart-plus me-1"></i>Quick Add
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @livewire('HomeProductFilterComponent')
@endsection


