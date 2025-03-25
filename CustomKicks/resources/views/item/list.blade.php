@extends('layouts.app')
 
@section('title', $title)
 
@section('content')
<div class="container mt-4">
<h1 class="mb-3">Your Cart</h1>
 
    {{-- Mensaje de éxito o error --}}
    @if(session('success'))
<div class="alert alert-success text-center">
            {{ session('success') }}
</div>
    @endif
 
    @if(session('error'))
<div class="alert alert-danger text-center">
            {{ session('error') }}
</div>
    @endif
 
    @if(count($cartItems) > 0)
<ul class="list-group mb-4">
            @foreach($cartItems as $index => $item)
<li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row">
<div>
<strong>{{ $item['product_name'] }}</strong><br>
<small>
                            Color: {{ $item['customization']['color'] ?? 'N/A' }} |
                            Design: {{ $item['customization']['design'] ?? 'N/A' }} |
                            Pattern: {{ $item['customization']['pattern'] ?? 'N/A' }}<br>
                            Subtotal: ${{ $item['subtotal'] }}
</small>
</div>
 
                    {{-- Botón para eliminar el ítem --}}
<form action="{{ route('item.remove', $index) }}" method="POST" class="mt-2 mt-md-0">
                        @csrf
                        @method('DELETE')
<button class="btn btn-sm btn-danger">Remove</button>
</form>
</li>
            @endforeach
</ul>
 
        {{-- Botón para limpiar el carrito --}}
<form action="{{ route('item.clear') }}" method="POST">
            @csrf
            @method('DELETE')
<button class="btn btn-warning w-100">Clear Cart</button>
</form>
 
        {{-- Botón para proceder al pago --}}
<a href="{{ route('order.checkout') }}" class="btn btn-success w-100 mt-3">
            Proceed to Checkout
</a>
 
        {{-- NUEVO: Botón para salvar ítems en la base de datos --}}
<form action="{{ route('item.save') }}" method="POST">
            @csrf
<button type="submit" class="btn btn-primary w-100 mt-3">Salvar Ítems</button>
</form>
 
    @else
<p class="text-muted">Your cart is empty.</p>
    @endif
</div>
@endsection