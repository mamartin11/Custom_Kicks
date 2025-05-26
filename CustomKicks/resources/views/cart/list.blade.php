@extends('layouts.app')

@section('title', $viewData['title'])

@section('content')
<div class="container mt-4">
    <h1 class="mb-3">{{ __('cart/list.title') }}</h1>

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

    @if(!empty($viewData['cartItems']))
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('cart/list.product') }}</th>
                        <th>{{ __('cart/list.customization') }}</th>
                        <th>{{ __('cart/list.price') }}</th>
                        <th>{{ __('cart/list.actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($viewData['cartItems'] as $index => $item)
                        <tr>
                            <td>{{ $item['product_name'] }}</td>
                            <td>
                                <strong>{{ __('cart/list.color') }}:</strong> {{ $item['customization']['color'] }}<br>
                                <strong>{{ __('cart/list.design') }}:</strong> {{ $item['customization']['design'] }}<br>
                                <strong>{{ __('cart/list.pattern') }}:</strong> {{ $item['customization']['pattern'] }}
                            </td>
                            <td>${{ number_format($item['subtotal'], 2) }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $index) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                                    <button class="btn btn-sm btn-danger">{{ __('cart/list.remove') }}</button>
                    </form>
                            </td>
                        </tr>
            @endforeach
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
                    <button class="btn btn-warning w-100">{{ __('cart/list.clear_cart') }}</button>
        </form>
            </div>
            <div class="col-md-6">
        @auth
                    <a href="{{ route('order.checkout') }}" class="btn btn-success w-100">
                        {{ __('cart/list.checkout') }}
            </a>
        @else
                    <p>{{ __('cart/list.login_required') }} <a href="{{ route('login') }}">{{ __('cart/list.login') }}</a></p>
                    <p>{{ __('cart/list.no_account') }} <a href="{{ route('register') }}">{{ __('cart/list.register_here') }}</a>.</p>
                @endauth
            </div>
        </div>
    @else
        <p class="text-muted text-center">{{ __('cart/list.empty_cart') }}</p>
    @endif
</div>
@endsection 