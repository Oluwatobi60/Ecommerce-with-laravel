
@extends('admin.layouts.layout')
@section('admin_page_title')
Manage Attributes - Admin Panel
@endsection
@section('admin_layout')
    <div class="row">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title mb-0">All Attributes</h4>
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
                                <th scope="col">Attribute</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($allAttributes as $attribute)
                            <tr>
                                <th scope="row">{{ $attribute->id }}</th>
                                <td>{{ $attribute->attribute_value }}</td>

                                <td>
                                    <a href="{{ route('attribute.show', $attribute->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                    <form action="{{ route('attribute.delete', $attribute->id) }}" method="POST" style="display: inline;">
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