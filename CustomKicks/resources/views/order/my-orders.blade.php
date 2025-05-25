@extends('layouts.app')

@section('title', __('order/my-orders.title'))

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">{{ __('order/my-orders.heading') }}</h1>

    @if(count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('order/my-orders.id') }}</th>
                        <th>{{ __('order/my-orders.date') }}</th>
                        <th>{{ __('order/my-orders.total') }}</th>
                        <th>Estado</th>
                        <th>{{ __('order/my-orders.details') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->getId() }}</td>
                            <td>{{ $order->getOrderDate() }}</td>
                            <td>${{ number_format($order->getTotal(), 2) }}</td>
                            <td>
                                @if(($order->status ?? $order->getStatus()) === 'completed')
                                    <span class="badge bg-success">Completada</span>
                                @else
                                    <span class="badge bg-warning">Pendiente</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#orderDetails{{ $order->getId() }}">
                                    {{ __('order/my-orders.view_details') }}
                                </button>
                                
                                <!-- Modal para mostrar los detalles -->
                                <div class="modal fade" id="orderDetails{{ $order->getId() }}" tabindex="-1" aria-labelledby="orderDetailsLabel{{ $order->getId() }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="orderDetailsLabel{{ $order->getId() }}">{{ __('order/my-orders.order_details') }}{{ $order->getId() }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="mb-3">{{ __('order/my-orders.date') }}: {{ $order->getOrderDate() }}</h6>
                                                <ul class="list-group mb-3">
                                                    @foreach($order->getDetails() as $item)
                                                        <li class="list-group-item">
                                                            <strong>{{ $item['product_name'] }}</strong><br>
                                                            <small>
                                                                {{ __('order/my-orders.color') }}: {{ $item['customization']['color'] }} |
                                                                {{ __('order/my-orders.design') }}: {{ $item['customization']['design'] }} |
                                                                {{ __('order/my-orders.pattern') }}: {{ $item['customization']['pattern'] }}<br>
                                                                {{ __('order/my-orders.subtotal') }}: ${{ $item['subtotal'] }}
                                                            </small>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <div class="text-end">
                                                    <p><strong>{{ __('order/my-orders.discount') }}: 
                                                        @php
                                                            // Obtener un descuento aleatorio entre los posibles valores de la ruleta
                                                            $discountValues = [0, 10, 20, 50];
                                                            $randomDiscount = $discountValues[array_rand($discountValues)];
                                                            echo $randomDiscount . '%';
                                                        @endphp
                                                    </strong></p>
                                                    <strong>{{ __('order/my-orders.total') }}: ${{ number_format($order->getTotal(), 2) }}</strong>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('order/my-orders.close') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info">
            {{ __('order/my-orders.no_orders') }}
            <a href="{{ route('product.index') }}" class="btn btn-primary mt-3">{{ __('order/my-orders.view_products') }}</a>
        </div>
    @endif
</div>
@endsection 