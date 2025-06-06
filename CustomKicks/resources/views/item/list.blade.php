@extends('layouts.app')
<!-- Nicolas-->
@section('title', __('item/list.title'))

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">{{ __('item/list.subtitle') }}</h1>

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
                            {{ __('item/list.color') }}: {{ $item['customization']['color'] ?? 'N/A' }} |
                            {{ __('item/list.design') }}: {{ $item['customization']['design'] ?? 'N/A' }} |
                            {{ __('item/list.pattern') }}: {{ $item['customization']['pattern'] ?? 'N/A' }}<br>
                            {{ __('item/list.subtotal') }}: ${{ $item['subtotal'] }}
                        </small>
                    </div>

                    <form action="{{ route('item.remove', $index) }}" method="POST" class="mt-2 mt-md-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">{{ __('item/list.remove') }}</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('item.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning w-100">{{ __('item/list.clear') }}</button>
        </form>

        <a href="{{ route('order.checkout') }}" class="btn btn-success w-100 mt-3">
            {{ __('item/list.checkout') }}
        </a>

        <form action="{{ route('item.save') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary w-100 mt-3">{{ __('item/list.items') }}</button>
        </form>
    @else
        <p class="text-muted text-center">{{ __('item/list.empty') }}</p>
    @endif
</div>
@endsection
