@extends('layouts.app')

@section('title', $viewData["title"])

@section('subtitle', $viewData["subtitle"])

@section('content')

<div class="row">
    @foreach ($viewData["products"] as $product)
        <div class="col-md-4 col-lg-3 mb-3">
            <div class="card text-center">
                <!-- Nombre del producto en la parte superior -->
                <h5 class="card-header">{{ $product->getName() }}</h5>

                <!-- Imagen del producto almacenada en la base de datos -->
                <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top img-fluid" style="object-fit: contain; height: 200px;">

                <div class="card-body">
                    
                    
                    <!-- Botón con el precio del producto -->
                    <a href="{{ route('product.show', $product->getId()) }}" class="btn btn-primary">
                        ${{ number_format($product->getPrice(), 2) }}
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>

@endsection
