
@extends('admin.layouts.layout')
@section('admin_page_title')
Create Sub Category - Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Sub Category</h4>
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

                <form action="{{ route('storesub.cat') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="subcategory_name" class="form-label fw-bold mb-2">Give Name of Your Sub Category Name</label>
                        <input type="text" class="form-control" id="subcategory_name" name="subcategory_name" placeholder="Enter subcategory name">

                         <label for="category_id" class="form-label fw-bold mb-2">Select Category</label>
                         <select class="form-select" id="category_id" name="category_id">
                             <option selected disabled>Select a category</option>
                             @foreach($categories as $category)
                                 <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                             @endforeach    
                        </select>
                    <button type="submit" class="btn btn-primary w-100 mt-2">Add Sub Category</button>
                </form>

            </div>
        </div>
    </div>
@endsection