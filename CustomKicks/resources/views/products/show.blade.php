@extends('layouts.app')

@section('title', $viewData['title'])

@section('subtitle', $viewData['subtitle'])

@section('content')

<link rel="stylesheet" href="{{ asset('css/customization-carousel.css') }}">

<div class="card mb-4">
    <div class="row g-0">
        <div class="col-md-4">
            @if ($viewData['product']->getImage())
                <img src="{{ $viewData['product']->getImage() }}" class="img-fluid rounded-start" alt="Product Image">
            @else
                <img src="{{ asset('images/placeholder.png') }}" class="img-fluid rounded-start" alt="No image available">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $viewData['product']->getName() }}</h5>
                <p class="card-text">
                    <p><strong>Price:</strong> ${{ $viewData['product']->getPrice() }}</p>
                    <p><strong>Description:</strong> {{ $viewData['product']->getDescription() }}</p>
                    <p><strong>Brand:</strong> {{ $viewData['product']->getBrand() }}</p>
                    <p><strong>Size:</strong> {{ $viewData['product']->getSize() }}</p>
                </p>
            </div>
        </div>
    </div>
</div>

@if(session('success'))
    <div class="alert alert-success text-center">
        <p>{{ session('success') }}</p>
        <p><strong>Color:</strong> {{ session('selected_color') }}</p>
        <p><strong>Design:</strong> {{ session('selected_design') }}</p>
        <p><strong>Pattern:</strong> {{ session('selected_pattern') }}</p>
    </div>
@endif

<form method="POST" action="{{ route('cart.add') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
    <input type="hidden" name="customization_id" id="customization-id">

    <div class="carousel-section">
        <div class="coverflow">
            <div class="coverflow-container">
                @foreach($viewData['customizations'] as $customization)
                    <div class="coverflow-item"
                         data-id="{{ $customization->getId() }}"
                         data-color="{{ $customization->getColor() }}"
                         data-design="{{ $customization->getDesign() }}"
                         data-pattern="{{ $customization->getPattern() }}">
                        <div class="coverflow-card">
                            <img src="{{ asset('storage/' . $customization->getImage()) }}" alt="Customization">
                            <div class="coverflow-title">{{ $customization->getDesign() }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="carousel-controls">
            <button type="button" id="prevBtn" class="control-btn">⟨</button>
            <button type="submit" class="btn btn-primary submit-btn" disabled id="submit-btn">
                Add to Cart
            </button>
            <button type="button" id="nextBtn" class="control-btn">⟩</button>
        </div>
    </div>
</form>

<script src="{{ asset('js/customization-carousel.js') }}"></script>

@endsection 