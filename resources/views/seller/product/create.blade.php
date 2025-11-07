
@extends('seller.layouts.layout')
@section('seller_page_title')
Add Product - Seller Panel
@endsection
@section('seller_layout')

                <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Add Product</h4>
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

                <form action="{{route('vendor.product.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="product_name" class="form-label fw-bold mb-2">Give Name of Your Product</label>
                        <input type="text" class="form-control mb-2" id="product_name" name="product_name" placeholder="Enter product name">

                         <label for="description" class="form-label fw-bold mb-2">Description</label>
                        <textarea class="form-control mb-2" id="description" rows="10" cols="30" name="description" placeholder="Enter product description"></textarea>

                        <label for="images" class="form-label fw-bold mb-2">Upload Your Product Images</label>
                        <input type="file" class="form-control mb-2" id="images" name="images[]" multiple>
                       
                       <label for="sku" class="form-label fw-bold mb-2">SKU</label>
                        <input type="text" class="form-control mb-2" id="sku" name="sku" placeholder="LXD3402">
                       
                        <livewire:category-subcategory />

                         <label for="store_id" class="form-label fw-bold mb-2">Select Your Store For This Product</label>
                       <select class="form-select mb-2" name="store_id">
                        @foreach($stores as $store)
                            <option disabled selected>Select Store </option>
                           <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                       @endforeach
                       </select>

                        <label for="regular_price" class="form-label fw-bold mb-2">Product Regular Price</label>
                        <input type="number" class="form-control mb-2" id="regular_price" name="regular_price">

                         <label for="discounted_price" class="form-label fw-bold mb-2">Discounted Price (if any)</label>
                        <input type="number" class="form-control mb-2" id="discounted_price" name="discounted_price">

                         <label for="tax_rate" class="form-label fw-bold mb-2">Tax</label>
                        <input type="number" class="form-control mb-2" id="tax_rate" name="tax_rate">

                         <label for="stock_quantity" class="form-label fw-bold mb-2">Stock Quantity</label>
                        <input type="number" class="form-control mb-2" id="stock_quantity" name="stock_quantity">

                         <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control mb-2" id="slug" name="slug">

                       <label for="meta_title" class="form-label fw-bold mb-2">Meta Title</label>
                        <input type="text" class="form-control mb-2" id="meta_title" name="meta_title">

                       <label for="meta_description" class="form-label fw-bold mb-2">Meta Description</label>
                        <textarea class="form-control mb-2" id="meta_description" rows="10" cols="30" name="meta_description"></textarea>

                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-2">Add Product</button>
                </form>

            </div>
        </div>
    </div>
@endsection