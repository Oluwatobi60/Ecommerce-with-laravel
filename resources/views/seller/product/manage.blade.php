
@extends('seller.layouts.layout')
@section('seller_page_title')
Manage Product - Seller Panel
@endsection
@section('seller_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Products</h4>
            </div>

              @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                
            <div class="card-body">
            <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Regular Price</th>
                                <th scope="col">Images</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productsdata as $product)
                            <tr>
                                <th scope="row">{{ $product->id }}</th>
                                <td>{{ $product->product_name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>${{ $product->regular_price }}</td>
                                <td>
                                    
                                    @if($product->images && $product->images->count() > 0)
                                        @foreach($product->images->take(2) as $image)
                                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover; margin-right: 5px;">
                                        @endforeach
                                        @if($product->images->count() > 3)
                                            <span class="badge bg-secondary">+{{ $product->images->count() - 3 }} more</span>
                                        @endif
                                    @else
                                        <span class="text-muted">No images</span>
                                    @endif
                                </td>
                                <td>
                                     <a href="{{ route('product.view', $product->id) }}" class="btn btn-sm btn-success">View</a>
                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection