@extends('layouts.app')

@section('title', 'Seguimiento de Pedido')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/tracking.css') }}">
@endpush

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Seguimiento de Pedido</h5>
                </div>
                <div class="card-body">
                    <form id="trackingForm" class="mb-4">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control" id="orderId" 
                                   placeholder="Ingresa el ID de tu pedido" required>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-search"></i> Buscar
                            </button>
                        </div>
                    </form>

                    <div id="trackingResult" class="d-none">
                        <div class="order-info mb-4">
                            <h6>Información del Pedido</h6>
                            <p class="mb-1"><strong>ID del Pedido:</strong> <span id="trackingOrderId"></span></p>
                            <p class="mb-1"><strong>Fecha de Pedido:</strong> <span id="trackingOrderDate"></span></p>
                            <p class="mb-1"><strong>Descuento:</strong> <span id="trackingOrderDiscount"></span></p>
                            <p class="mb-1"><strong>Total:</strong> <span id="trackingOrderTotal"></span></p>
                            <p class="mb-1"><strong>Tipo de Envío:</strong> <span id="trackingShippingType"></span></p>
                        </div>

                        <div class="tracking-status">
                            <div class="tracking-progress">
                                <div class="tracking-step">
                                    <div class="tracking-icon">
                                        <i class="fas fa-check"></i>
                                    </div>
                                    <div class="tracking-info">
                                        <h6>Pedido Confirmado</h6>
                                        <small>Pendiente</small>
                                    </div>
                                </div>
                                <div class="tracking-step">
                                    <div class="tracking-icon">
                                        <i class="fas fa-box"></i>
                                    </div>
                                    <div class="tracking-info">
                                        <h6>En Preparación</h6>
                                        <small>Pendiente</small>
                                    </div>
                                </div>
                                <div class="tracking-step">
                                    <div class="tracking-icon">
                                        <i class="fas fa-truck"></i>
                                    </div>
                                    <div class="tracking-info">
                                        <h6>En Tránsito</h6>
                                        <small>Pendiente</small>
                                    </div>
                                </div>
                                <div class="tracking-step">
                                    <div class="tracking-icon">
                                        <i class="fas fa-home"></i>
                                    </div>
                                    <div class="tracking-info">
                                        <h6>Entregado</h6>
                                        <small>Pendiente</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="trackingError" class="alert alert-danger d-none">
                        No se encontró ningún pedido con ese ID.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/tracking.js') }}"></script>
@endpush 