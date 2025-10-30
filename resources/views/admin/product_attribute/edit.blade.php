
@extends('admin.layouts.layout')
@section('admin_page_title')
Edit Attribute - Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Edit Attribute</h4>
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

                <form action="{{ route('attribute.update', $attribute->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- PUT is a method for updating exisitng information  -->
                    @method('PUT')
                    <div class="mb-3">
                        <label for="attribute_value" class="form-label fw-bold mb-2">Attribute Value</label>
                        <input type="text" class="form-control" id="attribute_value" name="attribute_value" value="{{ $attribute->attribute_value }}">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Attribute</button>
                </form>

            </div>
        </div>
    </div>
@endsection