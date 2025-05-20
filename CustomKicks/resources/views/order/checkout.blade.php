@extends('layouts.app')
<!-- Jacobo, Nicolas--> 
@section('title', __('order/checkout.title'))
 
@section('content')
<div class='container mt-4'>
   
    <div id='print-area'>
        <h1 class='mb-4'>{{ __('order/checkout.subtitle') }}</h1>
 
        @if(count($items) > 0)
            <ul class='list-group mb-4'>
                @foreach($items as $item)
                    <li class='list-group-item'>
                        <strong>{{ $item['product_name'] }}</strong><br>
                        <small>
                        {{ __('order/checkout.color') }}: {{ $item['customization']['color'] }} |
                        {{ __('order/checkout.design') }}: {{ $item['customization']['design'] }} |
                        {{ __('order/checkout.pattern') }}: {{ $item['customization']['pattern'] }}<br>
                        {{ __('order/checkout.subtotal') }}: ${{ $item['subtotal'] }}
                        </small>
                    </li>
                @endforeach
            </ul>
            <div class='mb-4 text-center'>
                <p><strong>{{ __('order/checkout.actual_budget') }}:</strong> ${{ number_format($userBudget, 2) }}</p>
                <p id='totalSection'><strong>{{ __('order/checkout.total') }}:</strong> $<span id='total'>{{ number_format($total, 2) }}</span></p>
 
                {{-- Se oculta hasta que se gire la ruleta --}}
                <div id='discount-info' class='d-none'>
                    <p><strong>{{ __('order/checkout.total_before_discount') }}:</strong> ${{ number_format($total, 2) }}</p>
                    <p><strong>{{ __('order/checkout.discount') }}:</strong> <span id='discountValue'>0</span>%</p>
                    <p><strong>{{ __('order/checkout.total_after_discount') }}:</strong> $<span id='totalAfterDiscount'>{{ number_format($total, 2) }}</span></p>
                </div>
 
                <div class='budget-container'>
                    <strong>{{ __('order/checkout.remaining_budget') }}:</strong>
                    <div id='counter' class='count-up-text' data-budget="{{ $userBudget }}">{{ number_format($remainingBudget, 2) }}</div>
                </div>
            </div>
        @else
            <p class='text-muted'>{{ __('order/checkout.no_items') }}</p>
        @endif
    </div>
 
    @if(count($items) > 0)
        <div class='text-end'>
            <button class='btn btn-warning me-2' id='spinWheelBtn' data-bs-toggle='modal' data-bs-target='#discountModal'>
            {{ __('order/checkout.wheel') }}
            </button>
 
            <button class='btn btn-primary d-none' id='confirmBtn' data-bs-toggle='modal' data-bs-target='#confirmModal'>
            {{ __('order/checkout.button') }}
            </button>
        </div>
    @endif
 
    @include('order.partials.confirm-modal')

    @include('order.partials.discount-wheel')
 
    <div id='confirmationMessage' class='alert alert-success mt-4 d-none text-center'>
    {{ __('order/checkout.confirmation') }}
    </div>
</div>
@endsection
 
@push('styles')
<link rel='stylesheet' href='{{ asset('css/budget-checkout.css') }}'>
<link rel='stylesheet' href='{{ asset('css/discount-wheel.css') }}'>
@endpush
 
@push('scripts')
<script src='{{ asset('js/checkout.js') }}'></script>
<script src='{{ asset('js/discount-wheel.js') }}'></script>
@endpush