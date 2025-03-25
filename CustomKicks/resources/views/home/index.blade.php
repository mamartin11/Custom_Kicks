@extends('layouts.app')

@section('title', __('home/index.title'))

@section('subtitle', __('home/index.subtitle'))

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">


<!-- Initial message -->
<div class="container text-center my-5">
    <img src="{{ asset('images/logo.jpeg') }}" class="img-fluid rounded w-50" alt="Bienvenido a Custom Kicks">
    <h1 class="mt-4">{{__('home/index.initial_message')}}</h1>
    <p class="lead">{{__('home/index.initial_description')}}</p>
    <a href="{{ route('product.index') }}" class="btn btn-dark btn-lg">{{__('home/index.initial_button')}}</a>
</div>

<!-- About Custom Kicks -->
<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-between">
            <div>
                <h2>{{__('home/index.about_title')}}</h2>
                <p>
                    {{__('home/index.about_description')}}
                </p>
            </div>
            <!-- Nueva imagen debajo del texto -->
            <img src="{{ asset('images/about2.webp') }}" class="img-fluid rounded mt-3" alt="Nuestro proceso de trabajo">
        </div>
        <div class="col-lg-6">
            <img src="{{ asset('images/about.webp') }}" class="img-fluid rounded mt-3" alt="Sobre nosotros">
        </div>
    </div>
</div>


<!-- Services -->
<div class="container my-5 text-center">
    <h2>{{__('home/index.services_title')}}</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <h4>{{__('home/index.service1')}}</h4>
            <p>{{__('home/index.service1_description')}}</p>
            <img src="{{ asset('images/service1.webp') }}" class="img-fluid rounded mb-3" alt="Personalización Total">
        </div>
        <div class="col-md-4">
            <h4>{{__('home/index.service2')}}</h4>
            <p>{{__('home/index.service2_description')}}</p>
            <img src="{{ asset('images/service2.webp') }}" class="img-fluid rounded mb-3" alt="Diseños Exclusivos">
        </div>
        <div class="col-md-4">
            <h4>{{__('home/index.service3')}}</h4>
            <p>{{__('home/index.service3_description')}}</p>
            <img src="{{ asset('images/service3.webp') }}" class="img-fluid rounded mb-3" alt="Restauración y Reparación">
        </div>
    </div>
</div>

<!-- Carousel -->
<div class="container my-5">
        <h2 class="text-center">{{__('home/index.carousel_title')}}</h2>
        <div id="carouselSneakers" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-inner text-center"> <!-- Centrar imágenes -->
                @foreach($viewData['products'] as $key => $product)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img src="{{ asset('storage/' . $product->getImage()) }}" class="d-block mx-auto img-fluid rounded" style="max-width: 60%;" alt="Sneaker {{ $key + 1 }}">
                    </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselSneakers" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                <span class="visually-hidden">{{__('home/index.carousel_back')}}</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSneakers" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                <span class="visually-hidden">{{__('home/index.carousel_next')}}</span>
            </button>
        </div>
    </div>

<!-- Newest -->
<div class="container my-5">
    <h2 class="text-center fw-bold">{{__('home/index.newest_title')}}</h2>
    <p class="text-center text-muted">{{__('home/index.newest_description')}}</p>
    
    <div class="row mt-4">
        @foreach($viewData['newest'] as $product)
        <div class="col-md-4">
            <div class="card shadow-lg border-0 rounded-3 overflow-hidden product-card">
                <div class="image-container">
                    <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top" style="max-width: 60%; alt="{{ $product->getName() }}">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">{{ $product->getName() }}</h5>
                    <p class="card-text text-success fw-bold fs-5">${{ number_format($product->getPrice(), 2) }}</p>
                    <a href="{{ route('item.show', $product->getId()) }}" class="btn btn-dark w-100">{{__('home/index.newest_button')}}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
