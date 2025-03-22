@extends('layouts.app')

@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])

@section('content')

<link rel="stylesheet" href="{{ asset('css/customization-carousel.css') }}">

{{-- PRODUCTO --}}
<div class="card mb-4">
    <div class="row g-0">
        <div class="col-md-4">
            <img src="{{ asset('storage/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start" alt="Product Image">
        </div>
        <div class="col-md-8">
            <div class="card-body">
                <h5 class="card-title">{{ $viewData['product']->getName() }}</h5>
                <p class="card-text">
                    @foreach($viewData['product']->getAttributes() as $key => $value)
                        @if(!in_array($key, ['id','image','created_at', 'updated_at']))
                            <p><strong>{{ ucfirst(str_replace('_', ' ', $key)) }}:</strong> {{ $value }}</p>
                        @endif
                    @endforeach
                </p>
            </div>
        </div>
    </div>
</div>

{{-- MENSAJE DE ÉXITO --}}
@if(session('success'))
    <div class="alert alert-success text-center">
        <p>{{ session('success') }}</p>
        <p><strong>Color:</strong> {{ session('selected_color') }}</p>
        <p><strong>Design:</strong> {{ session('selected_design') }}</p>
        <p><strong>Pattern:</strong> {{ session('selected_pattern') }}</p>
    </div>
@endif

{{-- FORMULARIO UNIFICADO PARA CREAR ITEM --}}
<form method="POST" action="{{ route('items.store') }}">
    @csrf
    <input type="hidden" name="product_id" value="{{ $viewData['product']->getId() }}">
    <input type="hidden" name="customization_id" id="customization-id"> {{-- Se actualiza vía JS --}}
    <input type="hidden" name="order_id" value="1"> {{-- Ajusta dinámicamente según el usuario --}}
    <input type="hidden" name="product_price" value="{{ $viewData['product']->getPrice() }}">

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
                {{ __('customizations.use_customization') }}
            </button>
            <button type="button" id="nextBtn" class="control-btn">⟩</button>
        </div>
    </div>
</form>

<script src="{{ asset('js/customization-carousel.js') }}"></script>

@endsection

