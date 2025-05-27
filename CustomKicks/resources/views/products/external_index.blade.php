@extends('layouts.app') {{-- Assuming you have a main layout file --}}

@section('title', isset($pageTitle) ? $pageTitle : 'External Products')

@section('content')
<div class="container mt-4">
    <h1>{{ isset($pageTitle) ? $pageTitle : 'External Products' }}</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if(!empty($products))
        <div class="row">
            @foreach($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if(!empty($product['imagePath']))
                            <img src="{{ $externalProductService->getFullImageUrl($product['imagePath']) }}" class="card-img-top" alt="{{ $product['name'] ?? 'Product Image' }}" style="max-height: 200px; object-fit: contain; padding: 10px;">
                        @else
                            <img src="https://via.placeholder.com/300x200.png?text=No+Image" class="card-img-top" alt="No image available" style="max-height: 200px; object-fit: cover;"> {{-- Placeholder --}}
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $product['name'] ?? 'N/A' }}</h5>
                            <p class="card-text">{{ $product['description'] ?? 'No description available.' }}</p>
                            <p class="card-text">
                                <strong>Price:</strong> ${{ number_format($product['price'] ?? 0, 2) }}<br>
                                <strong>Brand:</strong> {{ $product['brand'] ?? 'N/A' }}<br>
                                <strong>Stock:</strong> {{ $product['stock'] ?? 0 }}<br>
                                <strong>Sold:</strong> {{ $product['sold'] ?? 0 }}<br>
                                @if(isset($product['category']) && is_array($product['category']))
                                    <strong>Category:</strong> {{ $product['category']['name'] ?? 'N/A' }}
                                @endif
                            </p>
                            {{-- The API shows a 'url' field which seems to be a detail URL for the product on the external site --}}
                            @if(!empty($product['url']))
                                <a href="{{ $product['url'] }}" class="btn btn-primary" target="_blank">View Details (External)</a>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif(!session('error'))
        <p>No products found or unable to load products.</p>
    @endif
</div>
@endsection 