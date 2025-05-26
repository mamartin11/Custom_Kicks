@extends('layouts.app')

@section('title', __('order/my-orders.title'))

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>{{ __('order/my-orders.heading') }}</h1>
        <a href="{{ route('order.tracking') }}" class="btn btn-primary">
            <i class="fas fa-truck"></i> Seguimiento de Pedidos
        </a>
    </div>

    @if(count($orders) > 0)
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>{{ __('order/my-orders.id') }}</th>
                        <th>{{ __('order/my-orders.date') }}</th>
                        <th>{{ __('order/my-orders.total') }}</th>
                        <th>{{ __('order/my-orders.type') }}</th>
                        <th>{{ __('order/my-orders.status') }}</th>
                        <th>{{ __('order/my-orders.details') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>
                                <span class="badge bg-primary">{{ $order->getId() }}</span>
                            </td>
                            <td>{{ $order->getOrderDate() }}</td>
                            <td>${{ number_format($order->getTotal(), 2) }}</td>
                            <td>
                                <span class="badge {{ $order->getShippingType() === 'express' ? 'bg-danger' : 'bg-primary' }}">
                                    {{ $order->getShippingType() === 'express' ? 'Express' : 'Estándar' }}
                                </span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $order->getStatus() === 'completed' ? 'success' : 'warning' }}">
                                    {{ $order->getStatus() === 'completed' ? 'Completado' : 'En Proceso' }}
                                </span>
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
                                                <h5 class="modal-title" id="orderDetailsLabel{{ $order->getId() }}">
                                                    {{ __('order/my-orders.order_details') }}
                                                    <span class="badge bg-primary ms-2">{{ $order->getId() }}</span>
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="alert alert-info mb-3">
                                                    <i class="fas fa-info-circle"></i>
                                                    Para hacer seguimiento de este pedido, utiliza el ID: <strong>{{ $order->getId() }}</strong>
                                                </div>

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
                                                            $discountValues = [0, 10, 20, 50];
                                                            $randomDiscount = $discountValues[array_rand($discountValues)];
                                                            echo $randomDiscount . '%';
                                                        @endphp
                                                    </strong></p>
                                                    <strong>{{ __('order/my-orders.total') }}: ${{ number_format($order->getTotal(), 2) }}</strong>
                                                </div>

                                                <!-- Sección de cálculo de envío -->
                                                <div class="mt-4 border-top pt-3">
                                                    <h6 class="mb-3">Calcular Costo de Envío</h6>
                                                    <form id="shippingForm{{ $order->getId() }}" class="shipping-form">
                                                        @csrf
                                                        <input type="hidden" name="order_id" value="{{ $order->getId() }}">
                                                        <input type="hidden" name="order_total" value="{{ $order->getTotal() }}">
                                                        <div class="mb-3">
                                                            <label for="shipping_type{{ $order->getId() }}" class="form-label">Tipo de Envío</label>
                                                            <select class="form-select" id="shipping_type{{ $order->getId() }}" name="shipping_type" required>
                                                                <option value="standard">Envío Estándar (3-5 días)</option>
                                                                <option value="express">Envío Express (1-2 días)</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="distance{{ $order->getId() }}" class="form-label">Distancia de Envío (km)</label>
                                                            <input type="number" class="form-control" id="distance{{ $order->getId() }}" 
                                                                   name="distance" min="0" required>
                                                        </div>
                                                        <div class="d-flex gap-2">
                                                            <button type="submit" class="btn btn-primary">Calcular Envío</button>
                                                            <button type="button" class="btn btn-success confirm-shipping" 
                                                                    data-order-id="{{ $order->getId() }}"
                                                                    style="display: none;">
                                                                Confirmar Tipo de Envío
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <div id="shippingResult{{ $order->getId() }}" class="mt-3 d-none">
                                                        <div class="alert alert-info">
                                                            <p class="mb-0">Costo de Envío: <span class="shipping-cost fw-bold"></span></p>
                                                            <p class="mb-0">Fecha Estimada de Entrega: <span class="estimated-delivery fw-bold"></span></p>
                                                        </div>
                                                    </div>
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

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para obtener el token CSRF
    function getCsrfToken() {
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.content;
        }
        const csrfInput = document.querySelector('input[name="_token"]');
        if (csrfInput) {
            return csrfInput.value;
        }
        throw new Error('No se pudo encontrar el token CSRF');
    }

    // Manejar el envío de todos los formularios de cálculo de envío
    document.querySelectorAll('.shipping-form').forEach(form => {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const orderId = formData.get('order_id');
            const data = {
                order_id: orderId,
                order_total: parseFloat(formData.get('order_total')),
                distance: parseFloat(formData.get('distance')),
                shipping_type: formData.get('shipping_type')
            };

            try {
                const response = await fetch('/api/shipping/calculate-cost', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Error en la respuesta del servidor');
                }

                const result = await response.json();
                const resultDiv = document.getElementById(`shippingResult${orderId}`);
                const costSpan = resultDiv.querySelector('.shipping-cost');
                const estimatedDeliverySpan = resultDiv.querySelector('.estimated-delivery');
                const confirmButton = form.querySelector('.confirm-shipping');
                
                costSpan.textContent = `$${result.shipping_cost.toFixed(2)}`;
                estimatedDeliverySpan.textContent = result.estimated_delivery;
                resultDiv.classList.remove('d-none');
                confirmButton.style.display = 'inline-block';
            } catch (error) {
                console.error('Error:', error);
                alert('Error al calcular el costo de envío: ' + error.message);
            }
        });
    });

    // Manejar la confirmación del tipo de envío
    document.querySelectorAll('.confirm-shipping').forEach(button => {
        button.addEventListener('click', async function() {
            const orderId = this.dataset.orderId;
            const form = document.getElementById(`shippingForm${orderId}`);
            const formData = new FormData(form);
            
            try {
                const response = await fetch('/api/shipping/confirm-type', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        order_id: orderId,
                        shipping_type: formData.get('shipping_type')
                    })
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Error al confirmar el tipo de envío');
                }

                const result = await response.json();
                alert('Tipo de envío confirmado exitosamente');
                location.reload(); // Recargar la página para mostrar los cambios
            } catch (error) {
                console.error('Error:', error);
                alert('Error al confirmar el tipo de envío: ' + error.message);
            }
        });
    });
});
</script>
@endpush
@endsection 