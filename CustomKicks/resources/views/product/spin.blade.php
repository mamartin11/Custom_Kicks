@extends('layouts.app')

@section('content')
<div class="container text-center">
    <h1>{{ $viewData['title'] }}</h1>

    @if($viewData['spinning'])
        <div class="wheel-container">
            <div class="wheel"></div>
            <p class="mt-3">🎡 Girando...</p>
        </div>
        <meta http-equiv="refresh" content="3;url={{ route('spin.wheel', ['id' => $viewData['product']->id]) }}">
    @else
        <div class="wheel-result">
            <h2>{{ $viewData['product']->name }}</h2>
            <p>Precio original: <del>${{ number_format($viewData['originalPrice'], 0) }}</del></p>
            <p>Precio con descuento: <strong>${{ number_format($viewData['finalPrice'], 0) }}</strong></p>

            @if($viewData['result']['type'] === 'bonus')
                <p>🎉 ¡Ganaste un bono de ${{ number_format($viewData['result']['value'], 0) }}!</p>
            @elseif($viewData['result']['type'] === 'discount')
                <p>🎉 ¡Ganaste un descuento del {{ $viewData['result']['value'] }}%!</p>
            @else
                <p>😢 No ganaste nada, intenta otro día.</p>
            @endif
        </div>
        <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">Volver a productos</a>
    @endif
</div>

<style>
    .wheel-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        height: 300px;
    }
    .wheel {
        width: 200px;
        height: 200px;
        border-radius: 50%;
        background: conic-gradient(
            #ffcc00 0deg 90deg,
            #ff6600 90deg 180deg,
            #00cc66 180deg 270deg,
            #ff0033 270deg 360deg
        );
        border: 5px solid #333;
        position: relative;
        animation: spin 3s ease-out forwards;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate({{ rand(720, 1440) }}deg); }
    }
</style>
@endsection
