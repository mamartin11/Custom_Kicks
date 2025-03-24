@extends('layouts.app')

@section('title', __('order/checkout.title'))

@section('subtitle', __('order/checkout.subtitle'))

@section('content')
<div class="container mt-4">
    <div id="print-area">
        @if(count($viewData['items']) > 0)
            <ul class="list-group mb-4">
                @foreach($viewData['items'] as $item)
                    <li class="list-group-item">
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

            <div class="mb-4 text-center">
                <p><strong>{{ __('order/checkout.actual_budget') }}:</strong> ${{ number_format($viewData['userBudget'], 2) }}</p>
                <p><strong>{{ __('order/checkout.total') }}:</strong> ${{ number_format($viewData['total'], 2) }}</p>

                <div class="budget-container">
                    <strong>{{ __('order/checkout.remaining_budget') }}:</strong>
                    <div id="counter" class="count-up-text">{{ number_format($viewData['remainingBudget'], 2) }}</div>
                </div>
            </div>
        @else
            <p class="text-muted">{{ __('order/checkout.no_items') }}</p>
        @endif
    </div>

    @if(count($viewData['items']) > 0)
        <div class="text-end">
            <button class="btn btn-primary" id="confirmBtn" data-bs-toggle="modal" data-bs-target="#confirmModal">
            {{ __('order/checkout.button') }}
            </button>
        </div>
    @endif

    {{-- Modal --}}
    @include('order.partials.confirm-modal')

    {{-- Confirm Message --}}
    <div id="confirmationMessage" class="alert alert-success mt-4 d-none text-center">
    {{ __('order/checkout.confirmation') }}
    </div>
</div>
@endsection

@push('styles')
<link rel="stylesheet" href="{{ asset('css/budget-checkout.css') }}">
@endpush

@push('scripts')
<script src="{{ asset('js/checkout.js') }}"></script>
<script>
    // Lanza la animación
    document.addEventListener('DOMContentLoaded', function () {
        animateCount({
            from: {{ $viewData['userBudget'] }},
            to: {{ $viewData['remainingBudget'] }},
            duration: 2,
            direction: 'down',
            separator: ','
        });
    });
</script>
@endpush
