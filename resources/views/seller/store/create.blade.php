
@extends('seller.layouts.layout')
@section('seller_page_title')
Create New Store - Seller Panel
@endsection
@section('seller_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Store</h4>
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

                <form action="{{ route('create.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="store_name" class="form-label fw-bold mb-2">Store Name</label>
                        <input type="text" class="form-control" id="store_name" name="store_name" placeholder="Enter store name">

                        <label for="details" class="form-label fw-bold mb-2">Description of Your Store</label>
                        <textarea class="form-control" id="details" name="details" rows="10" cols="30" placeholder="Enter store description"></textarea>

                        <label for="slug" class="form-label fw-bold mb-2">Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug" placeholder="Enter store slug">

                    </div>
                    <button type="submit" class="btn btn-primary w-100">Create Store</button>
                </form>

            </div>
        </div>
    </div>
@endsection