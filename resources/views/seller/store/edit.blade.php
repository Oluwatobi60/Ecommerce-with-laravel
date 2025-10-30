
@extends('seller.layouts.layout')
@section('seller_page_title')
Edit Store - Seller Panel
@endsection
@section('seller_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Store</h4>
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

                <form action="{{ route('update.store', $store->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- PUT is a method for updating exisitng information  -->
                    @method('PUT')
                    <div class="mb-3">
                        <label for="store_name" class="form-label fw-bold mb-2">Store Name</label>
                        <input type="text" class="form-control" id="store_name" name="store_name" value="{{ $store->store_name }}">

                        <label for="details" class="form-label fw-bold mb-2">Description of Your Store</label>
                        <textarea class="form-control" id="details" name="details" rows="10" cols="30">{{ $store->details }}</textarea>

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" value="{{ $store->slug }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Store</button>
                </form>

            </div>
        </div>
    </div>
@endsection