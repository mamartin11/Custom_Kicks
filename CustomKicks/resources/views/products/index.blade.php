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
                        <label for="brand" class="form-label">{{ __('products/index.brand') }}</label>
                        <select name="brand" id="brand" class="form-select">
                            <option value="">{{ __('products/index.all_brands') }}</option>
                            @foreach($viewData['brands'] as $brand)
                                <option value="{{ $brand }}" {{ request('brand') == $brand ? 'selected' : '' }}>
                                    {{ $brand }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label for="min_price" class="form-label">{{ __('products/index.min_price') }}</label>
                        <input type="number" class="form-control" id="min_price" name="min_price" value="{{ request('min_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="max_price" class="form-label">{{ __('products/index.max_price') }}</label>
                        <input type="number" class="form-control" id="max_price" name="max_price" value="{{ request('max_price') }}">
                    </div>
                    <div class="col-md-3">
                        <label for="size" class="form-label">{{ __('products/index.size') }}</label>
                        <input type="number" step="0.5" class="form-control" id="size" name="size" value="{{ request('size') }}">
                    </div>
                    <div class="col-12 mt-4">
                        <button type="submit" class="btn btn-primary w-100">{{ __('products/index.filter') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="row">
        @forelse($viewData['products'] as $product)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($product->getImage())
                        <img src="{{ $product->getImage() }}" class="card-img-top" alt="{{ $product->getName() }}">
                    @else
                        <img src="{{ asset('images/placeholder.png') }}" class="card-img-top" alt="No image available">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->getName() }}</h5>
                        <p class="card-text">
                            <strong>{{ __('products/index.price') }}:</strong> ${{ $product->getPrice() }}<br>
                            <strong>{{ __('products/index.brand') }}:</strong> {{ $product->getBrand() }}<br>
                            <strong>{{ __('products/index.size') }}:</strong> {{ $product->getSize() }}
                        </p>
                        <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-primary w-100">{{ __('products/index.view') }}</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">
                    {{ __('products/index.no_products') }}
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection 