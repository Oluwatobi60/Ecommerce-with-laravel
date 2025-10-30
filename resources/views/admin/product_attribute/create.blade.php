
@extends('admin.layouts.layout')
@section('admin_page_title')
Create Default Attribute - Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">Create Default Attribute</h4>
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

                <form action="{{ route('attribute.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="attribute_value" class="form-label fw-bold mb-2">Give Name of Your Attribute</label>
                        <input type="text" class="form-control" id="attribute_value" name="attribute_value" placeholder="XL">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Add Attribute</button>
                </form>

            </div>
        </div>
    </div>
@endsection