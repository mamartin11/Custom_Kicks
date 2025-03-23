@extends('layouts.app')

@section('title', 'Custom Kicks - Home')

@section('subtitle', 'Sneakers únicos para personas únicas')

@section('content')

<link rel="stylesheet" href="{{ asset('css/home.css') }}">


<!-- Hero Section -->
<div class="container text-center my-5">
    <img src="{{ asset('images/logo.jpeg') }}" class="img-fluid rounded w-50" alt="Bienvenido a Custom Kicks">
    <h1 class="mt-4">¡Crea tu estilo con sneakers personalizados!</h1>
    <p class="lead">Cada par de sneakers es una obra de arte única. Personaliza los tuyos ahora.</p>
    <a href="{{ route('product.index') }}" class="btn btn-dark btn-lg">Explorar Sneakers</a>
</div>

<!-- Sobre Nosotros -->
<div class="container my-5">
    <div class="row">
        <div class="col-lg-6 d-flex flex-column justify-content-between">
            <div>
                <h2>¿Qué es Custom Kicks?</h2>
                <p>
                    Somos un equipo de artistas dedicados a transformar sneakers en piezas únicas. 
                    Trabajamos con materiales de alta calidad para asegurarte un diseño exclusivo y duradero.
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


<!-- Servicios -->
<div class="container my-5 text-center">
    <h2>Nuestros Servicios</h2>
    <div class="row mt-4">
        <div class="col-md-4">
            <img src="{{ asset('images/service1.webp') }}" class="img-fluid rounded mb-3" alt="Personalización Total">
            <h4>Personalización Total</h4>
            <p>Elige colores, texturas y diseños para hacer tu calzado único.</p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/service2.webp') }}" class="img-fluid rounded mb-3" alt="Diseños Exclusivos">
            <h4>Diseños Exclusivos</h4>
            <p>Colaboramos con artistas para ofrecer ediciones limitadas.</p>
        </div>
        <div class="col-md-4">
            <img src="{{ asset('images/service3.webp') }}" class="img-fluid rounded mb-3" alt="Restauración y Reparación">
            <h4>Restauración y Reparación</h4>
            <p>Revive tus sneakers favoritos con nuestro servicio de restauración.</p>
        </div>
    </div>
</div>

<!-- Carrusel de Sneakers Personalizados -->
<div class="container my-5">
        <h2 class="text-center">{{ $viewData['subtitle'] }}</h2>
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
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselSneakers" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true" style="filter: invert(100%);"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </div>

<!-- Productos Destacados -->
<div class="container my-5">
    <h2 class="text-center fw-bold">🔥 Lo Más Nuevo en la Tienda 🔥</h2>
    <p class="text-center text-muted">Descubre nuestros últimos diseños de sneakers personalizados</p>
    
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
                    <a href="{{ route('item.show', $product->getId()) }}" class="btn btn-dark w-100">Ver más</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
