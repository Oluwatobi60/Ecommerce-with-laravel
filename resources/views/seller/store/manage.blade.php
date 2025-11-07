
@extends('seller.layouts.layout')
@section('seller_page_title')
Manage Store - Seller Panel
@endsection
@section('seller_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Store</h4>
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
                                <th scope="col">Store Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Slug</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($storedata as $store)
                            <tr>
                                <th scope="row">{{ $store->id }}</th>
                                <td>{{ $store->store_name }}</td>
                                <td>{{ $store->details }}</td>
                                <td>{{ $store->slug }}</td>

                                <td>
                                    <a href="{{ route('edit.store', $store->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('delete.store', $store->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
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