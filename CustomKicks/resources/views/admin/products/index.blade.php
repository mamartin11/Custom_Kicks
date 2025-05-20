@extends('layouts.app')

@section('title', 'Admin - Products')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>Product Management</span>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary">Add New</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Price</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewData['products'] as $product)
                                    <tr>
                                        <td>{{ $product->getId() }}</td>
                                        <td>
                                            @if($product->getImage())
                                                <img src="{{ asset('storage/' . $product->getImage()) }}" 
                                                     alt="{{ $product->getName() }}" width="50">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $product->getName() }}</td>
                                        <td>{{ $product->getBrand() }}</td>
                                        <td>${{ $product->getPrice() }}</td>
                                        <td>{{ $product->getSize() }}</td>
                                        <td>{{ $product->getQuantity() }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{ route('admin.products.edit', $product->getId()) }}" 
                                                   class="btn btn-sm btn-primary">Edit</a>
                                                <a href="{{ route('admin.products.destroy', $product->getId()) }}" 
                                                   class="btn btn-sm btn-danger" 
                                                   onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 