@extends('layouts.app')

@section('title', __('item/list.title'))

@section('subtitle', __('item/list.subtitle'))

@section('content')
<div class="container mt-4">

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(count($viewData['cartItems']) > 0)
        <ul class="list-group mb-4">
            @foreach($viewData['cartItems'] as $index => $item)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <div>
                        <strong>{{ $item['product_name'] }}</strong><br>
                        <small>
                            {{ __('item/list.color') }}: {{ $item['customization']['color'] }} |
                            {{ __('item/list.design') }}: {{ $item['customization']['design'] }} |
                            {{ __('item/list.pattern') }}: {{ $item['customization']['pattern'] }}<br>
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
    @else
        <p class="text-muted">{{ __('item/list.empty') }}</p>
    @endif
</div>
@endsection
