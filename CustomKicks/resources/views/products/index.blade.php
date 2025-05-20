@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['subtitle'])

@section('content')
<div class="container">
    <div class="row mb-4">
        <div class="col-md-12">
            <form method="GET" action="{{ route('product.index') }}" class="card p-3">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand" id="brand" class="form-select">
                            <option value="">All Brands</option>
                            @foreach($viewData['brands'] as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">Min Price</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">Max Price</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="size" class="form-label">Size</label>
                        <input type="number" step="0.5" class="form-control" id="size" name="size" value="{{ request('size') }}">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($viewData['products'] as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top" alt="{{ $product->getName() }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->getName() }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ $product->getPrice() }}<br>
                            <strong>Brand:</strong> {{ $product->getBrand() }}<br>
                            <strong>Size:</strong> {{ $product->getSize() }}
                        </p>
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-primary w-100">View</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    No products found matching your criteria.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection 