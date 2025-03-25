@extends('layouts.app')
 
@section('title', $title)
 
@section('content')
<div class="container mt-4">
   
    {{-- Contenido de la Orden --}}
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
                            Subtotal: ${{ $item['subtotal'] }}
                        </small>
                    </li>
                @endforeach
            </ul>
            <div class="mb-4 text-center">
                <p><strong>Your Budget:</strong> ${{ number_format($userBudget, 2) }}</p>
                <p id="totalSection"><strong>Total:</strong> $<span id="total">{{ number_format($total, 2) }}</span></p>
 
                {{-- Se oculta hasta que se gire la ruleta --}}
                <div id="discount-info" class="d-none">
                    <p><strong>Total Before Discount:</strong> ${{ number_format($total, 2) }}</p>
                    <p><strong>Discount Applied:</strong> <span id="discountValue">0</span>%</p>
                    <p><strong>Total After Discount:</strong> $<span id="totalAfterDiscount">{{ number_format($total, 2) }}</span></p>
                </div>
 
                <div class="budget-container">
                    <strong>Remaining Budget:</strong>
                    <div id="counter" class="count-up-text">{{ number_format($remainingBudget, 2) }}</div>
                </div>
            </div>
        @else
            <p class="text-muted">No items in your cart.</p>
        @endif
    </div>
 
    @if(count($items) > 0)
        <div class="text-end">
            <button class="btn btn-warning me-2" id="spinWheelBtn" data-bs-toggle="modal" data-bs-target="#discountModal">
                Spin the Wheel
            </button>
 
            <button class="btn btn-primary d-none" id="confirmBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
                Confirm Order
            </button>
        </div>
    @endif
 
    {{-- Modal de Confirmación --}}
    @include('order.partials.confirm-modal')
 
    {{-- Modal de la Ruleta --}}
    @include('order.partials.discount-wheel')
 
    {{-- Confirm Message --}}
    <div id="confirmationMessage" class="alert alert-success mt-4 d-none text-center">
        Order confirmed successfully!
    </div>
</div>
@endsection
 
@push('styles')
<link rel="stylesheet" href="{{ asset('css/budget-checkout.css') }}">
<link rel="stylesheet" href="{{ asset('css/discount-wheel.css') }}">
@endpush
 
@push('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
<script src="{{ asset('js/discount-wheel.js') }}"></script>
@endpush