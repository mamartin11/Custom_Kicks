@extends('layouts.app')

@section('title', 'Edit Product')

@section('content')

<div class="container mt-4">
    <h2 class="mb-4">Edit Product</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('product.update', ['id' => $viewData['product']->getId()]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $viewData['product']->getName() }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $viewData['product']->getPrice() }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3" required>{{ $viewData['product']->getDescription() }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Brand</label>
            <input type="text" name="brand" class="form-control" value="{{ $viewData['product']->getBrand() }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Size</label>
            <input type="text" name="size" class="form-control" value="{{ $viewData['product']->getSize() }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Quantity</label>
            <input type="number" name="quantity" class="form-control" value="{{ $viewData['product']->getQuantity() }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Current Image</label>
            <div>
                <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}" class="img-fluid" style="max-width: 150px;">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Upload New Image</label>
            <input type="file" name="image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>

@endsection
