
@extends('admin.layouts.layout')
@section('admin_page_title')
Settings - Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Home Page Setting</h4>
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

                <form action="{{ route('admin.homepagesettings.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="discounted_product_id" class="form-label fw-bold mb-2">Select Discounted Product</label>
                        <select name="discounted_product_id" id="discounted_product_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->discounted_product_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                        <label for="discount_percentage" class="form-label fw-bold mb-2 mt-3">Discount Percentage (%)</label>
                        <input type="number" class="form-control" name="discount_percent" value="{{ $homepagesetting->discount_percent }}">


                          <label for="discount_heading" class="form-label fw-bold mb-2 mt-3">Provide Discount Heading</label>
                        <input type="text" class="form-control" name="discount_heading" value="{{ $homepagesetting->discount_heading }}">

                         <label for="discount_subheading" class="form-label fw-bold mb-2 mt-3">Provide Discount Sub Text</label>
                        <input type="text" class="form-control" name="discount_subheading" value="{{ $homepagesetting->discount_subheading }}">

                        <label for="featured_product_1_id" class="form-label fw-bold mb-2">Select Featured Product 1</label>
                        <select name="featured_product_1_id" id="featured_product_1_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->featured_product_1_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>


                        <label for="featured_product_2_id" class="form-label fw-bold mb-2">Select Featured Product 2</label>
                        <select name="featured_product_2_id" id="featured_product_2_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->featured_product_2_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>

                        <label for="featured_product_3_id" class="form-label fw-bold mb-2">Select Featured Product 3</label>
                        <select name="featured_product_3_id" id="featured_product_3_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->featured_product_3_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>

                        <label for="featured_product_4_id" class="form-label fw-bold mb-2">Select Featured Product 4</label>
                        <select name="featured_product_4_id" id="featured_product_4_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->featured_product_4_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>

                        <label for="featured_product_5_id" class="form-label fw-bold mb-2">Select Featured Product 5</label>
                        <select name="featured_product_5_id" id="featured_product_5_id" class="form-control">
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{  $homepagesetting->featured_product_5_id == $product->id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                            @endforeach
                        </select>

                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Homepage Setting</button>
                </form>

            </div>
        </div>
    </div>
@endsection