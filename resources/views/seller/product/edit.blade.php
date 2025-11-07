
@extends('seller.layouts.layout')
@section('seller_page_title')
Edit Product - Seller Panel
@endsection
@section('seller_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Product</h4>
            </div>
            <div class="card-body">

                @if ($errors->any())
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <ul>
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

                <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- PUT is a method for updating exisitng information  -->
                    @method('PUT')
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold mb-2">Product Name</label>
                        <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}">

                        <label for="images" class="form-label fw-bold mb-2">Product Images</label>
                        <input type="file" class="form-control" id="images" name="images[]" multiple>

                        <label for="images" class="form-label fw-bold mb-2">Current Images</label>
                        <div class="mb-3">
                            @if($product->images && $product->images->count() > 0)
                                @foreach($product->images as $image)
                                    <div class="d-inline-block me-2">
                                        <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div class="mt-1">
                                            <small class="text-muted">Image {{ $loop->iteration }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span class="text-muted">No images uploaded</span>
                            @endif
                        </div>

                        <label for="description" class="form-label fw-bold mb-2">Description of Your Product</label>
                        <textarea class="form-control" id="description" name="description" rows="10" cols="30">{{ $product->description }}</textarea>

                        <label for="sku" class="form-label fw-bold mb-2">Sku</label>
                        <input type="text" class="form-control" id="sku" name="sku" value="{{ $product->sku }}">

                        <livewire:category-subcategory />

                        <label for="store_id" class="form-label fw-bold mb-2">Select Your Store For This Product</label>
                       <select class="form-select mb-2" name="store_id">
                        <option disabled selected>Select Store </option>
                        @foreach($stores as $store)
                           <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                       @endforeach
                       </select>

                        <label for="regular_price" class="form-label fw-bold mb-2">Regular Price</label>
                        <input type="text" class="form-control" id="regular_price" name="regular_price" value="{{ $product->regular_price }}">

                        <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price</label>
                        <input type="text" class="form-control" id="discounted_price" name="discounted_price" value="{{ $product->discounted_price }}">

                        <label for="tax_rate" class="form-label fw-bold mb-2">Tax Rate (%)</label>
                        <input type="text" class="form-control" id="tax_rate" name="tax_rate" value="{{ $product->tax_rate }}">

                        <label for="stock_quantity" class="form-label fw-bold mb-2">Stock Quantity</label>
                        <input type="text" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $product->stock_quantity }}">

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $product->slug }}">

                        <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ $product->meta_title }}">

                        <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description" rows="5" cols="30">{{ $product->meta_description }}</textarea>

                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Product</button>
                </form>

                <!-- Image Management Section -->
                @if($product->images && $product->images->count() > 0)
                <div class="mt-4">
                    <h5>Manage Product Images</h5>
                    <div class="row">
                        @foreach($product->images as $image)
                        <div class="col-md-3 mb-3">
                            <div class="card">
                                <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" style="height: 150px; object-fit: cover;" alt="Product Image">
                                <div class="card-body p-2">
                                    <form action="#" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

            </div>
        </div>
    </div>
@endsection