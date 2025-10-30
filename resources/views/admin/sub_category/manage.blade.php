
@extends('admin.layouts.layout')
@section('admin_page_title')
Manage Sub Category
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Sub Category</h4>
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
                                <th scope="col">Sub Category</th>
                                <th scope="col">Category</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($subcategories as $subcat)
                            <tr>
                                <th scope="row">{{ $subcat->id }}</th>
                                <td>{{ $subcat->subcategory_name }}</td>
                                <td>{{ $subcat->category->category_name }}</td>
                                <td>
                                    <a href="{{ route('show.subcat', $subcat->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('delete.subcat', $subcat->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
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