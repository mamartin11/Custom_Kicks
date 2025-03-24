@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container mt-4">
    <div id="print-area">
        <h1 class="mb-4">Order Summary</h1>

        @if(count($items) > 0)
            <ul class="list-group mb-4">
                @foreach($items as $item)
                    <li class="list-group-item">
                        <strong>{{ $item['product_name'] }}</strong><br>
                        <small>
                            Color: {{ $item['customization']['color'] }} |
                            Design: {{ $item['customization']['design'] }} |
                            Pattern: {{ $item['customization']['pattern'] }}<br>
                            Subtotal: ${{ number_format($item['subtotal'], 2) }}
                        </small>
                    </li>
                @endforeach
            </ul>

            <div class="mb-4 text-center">
                <p><strong>Your Budget:</strong> ${{ number_format($userBudget, 2) }}</p>
                <p><strong>Total Order:</strong> ${{ number_format($total, 2) }}</p>

                <div class="budget-container">
                    <strong>Remaining Budget:</strong>
                    <div id="counter" class="count-up-text">{{ number_format($remainingBudget, 2) }}</div>
                </div>
            </div>
        @else
            <p class="text-muted">No items in your cart.</p>
        @endif
    </div>

    {{-- Mostrar resultado de la ruleta si hay uno --}}
    @if(session('spin_result'))
        <div class="alert alert-info text-center">
            <strong>Spin Result:</strong> 
            @if(session('spin_result')['type'] === 'bonus')
                🎉 You won a bonus of ${{ number_format(session('spin_result')['value'], 0) }}!
            @elseif(session('spin_result')['type'] === 'discount')
                🎉 You won a discount of {{ session('spin_result')['value'] }}%!
            @else
                😢 No discount this time. Try again later!
            @endif
        </div>
    @endif

    {{-- Sección para girar la ruleta --}}
    @if(count($items) > 0)
        <div class="text-center mt-5">
            <h2>🎡 Spin the Wheel!</h2>
            <div class="wheel-container">
                <div class="wheel" id="wheel"></div>
            </div>
            <form id="spin-form" method="POST" action="{{ route('spin.wheel', ['id' => $items[0]['product_id']]) }}">
                @csrf
                <button type="button" id="spin-button" class="btn btn-primary mt-3">Girar Ruleta</button>
            </form>
        </div>
    @endif

    {{-- Confirmación de pedido --}}
    @if(count($items) > 0)
        <div class="text-end mt-4">
            <button class="btn btn-primary" id="confirmBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
                Confirm Order
            </button>
        </div>
    @endif

    {{-- Modal --}}
    @include('order.partials.confirm-modal')

    {{-- Confirm Message --}}
    <div id="confirmationMessage" class="alert alert-success mt-4 d-none text-center">
        Order confirmed successfully!
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/budget-checkout.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        animateCount({
            from: {{ $userBudget }},
            to: {{ $remainingBudget }},
            duration: 2,
            direction: 'down',
            separator: ','
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const spinButton = document.getElementById('spin-button');
        const wheel = document.getElementById('wheel');
        const spinForm = document.getElementById('spin-form');

        if (spinButton && wheel && spinForm) {
            spinButton.addEventListener('click', function (e) {
                e.preventDefault();

                // Deshabilitar botón mientras gira la ruleta
                spinButton.disabled = true;
                spinButton.innerText = "Girando...";

                // Girar la ruleta con animación
                let degrees = 3600 + Math.floor(Math.random() * 360); // Giro aleatorio
                wheel.style.transition = "transform 3s ease-out";
                wheel.style.transform = `rotate(${degrees}deg)`;

                // Esperar a que termine la animación antes de enviar el formulario
                setTimeout(() => {
                    spinForm.submit();
                }, 3000);
            });
        }
    });

</script>
@endpush
