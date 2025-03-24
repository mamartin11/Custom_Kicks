@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">Your Cart</h1>

    @if(session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    @if(count($cartItems) > 0)
        <ul class="list-group mb-4">
            @foreach($cartItems as $index => $item)
                <li class="list-group-item d-flex justify-content-between align-items-center flex-column flex-md-row">
                    <div>
                        <strong>{{ $item['product_name'] }}</strong><br>
                        <small>
                            Color: {{ $item['customization']['color'] }} |
                            Design: {{ $item['customization']['design'] }} |
                            Pattern: {{ $item['customization']['pattern'] }}<br>
                            Subtotal: ${{ $item['subtotal'] }}
                        </small>
                    </div>

                    <form action="{{ route('item.remove', $index) }}" method="POST" class="mt-2 mt-md-0">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Remove</button>
                    </form>
                </li>
            @endforeach
        </ul>

        <form action="{{ route('item.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning w-100">Clear Cart</button>
        </form>
        <a href="{{ route('order.checkout') }}" class="btn btn-success w-100 mt-3">
          Proceed to Checkout
        </a>
    @else
        <p class="text-muted">Your cart is empty.</p>
    @endif
</div>
@endsection
