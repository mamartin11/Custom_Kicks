@extends('layouts.app')

@section('title', 'Servicio de Envíos')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Calculadora de Costos -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Calcular Costo de Envío</h5>
                </div>
                <div class="card-body">
                    <form id="calculateShippingForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="weight" class="form-label">Peso (kg)</label>
                                <input type="number" step="0.1" min="0.1" name="weight" id="weight" 
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="distance" class="form-label">Distancia (km)</label>
                                <input type="number" min="0" name="distance" id="distance" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Calcular Costo
                            </button>
                        </div>
                    </form>
                    <div id="shippingCostResult" class="mt-3 d-none">
                        <div class="alert alert-info">
                            <p class="mb-0">Costo de Envío: <span id="calculatedCost" class="fw-bold"></span></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Formulario de Envío -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Procesar Envío</h5>
                </div>
                <div class="card-body">
                    <form id="processShippingForm">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="order_id" class="form-label">ID de Orden</label>
                                <input type="text" name="order_id" id="order_id" 
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="weight" class="form-label">Peso (kg)</label>
                                <input type="number" step="0.1" min="0.1" name="weight" id="weight" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="distance" class="form-label">Distancia (km)</label>
                                <input type="number" min="0" name="distance" id="distance" 
                                       class="form-control" required>
                            </div>
                        </div>

                        <h6 class="mb-3">Dirección de Envío</h6>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="street" class="form-label">Calle</label>
                                <input type="text" name="address[street]" id="street" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">Ciudad</label>
                                <input type="text" name="address[city]" id="city" 
                                       class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="country" class="form-label">País</label>
                                <input type="text" name="address[country]" id="country" 
                                       class="form-control" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">
                                Procesar Envío
                            </button>
                        </div>
                    </form>
                    <div id="shippingResult" class="mt-3 d-none">
                        <div class="alert alert-success">
                            <h6 class="mb-2">Detalles del Envío</h6>
                            <div id="shippingDetails" class="small"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Función para obtener el token CSRF
    function getCsrfToken() {
        // Intentar obtener el token del meta tag
        const metaTag = document.querySelector('meta[name="csrf-token"]');
        if (metaTag) {
            return metaTag.content;
        }
        
        // Si no está en el meta tag, intentar obtenerlo del input hidden
        const csrfInput = document.querySelector('input[name="_token"]');
        if (csrfInput) {
            return csrfInput.value;
        }
        
        // Si no se encuentra en ningún lado, lanzar error
        throw new Error('No se pudo encontrar el token CSRF');
    }

    // Calculadora de Costos
    const calculateForm = document.getElementById('calculateShippingForm');
    const costResult = document.getElementById('shippingCostResult');
    const calculatedCost = document.getElementById('calculatedCost');

    calculateForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        const data = {
            weight: parseFloat(formData.get('weight')),
            distance: parseFloat(formData.get('distance'))
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
            calculatedCost.textContent = `$${result.shipping_cost.toFixed(2)}`;
            costResult.classList.remove('d-none');
        } catch (error) {
            console.error('Error:', error);
            alert('Error al calcular el costo de envío: ' + error.message);
        }
    });

    // Procesar Envío
    const processForm = document.getElementById('processShippingForm');
    const shippingResult = document.getElementById('shippingResult');
    const shippingDetails = document.getElementById('shippingDetails');

    processForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        const formData = new FormData(this);
        const data = {
            order_id: formData.get('order_id'),
            weight: parseFloat(formData.get('weight')),
            distance: parseFloat(formData.get('distance')),
            address: {
                street: formData.get('address[street]'),
                city: formData.get('address[city]'),
                country: formData.get('address[country]')
            }
        };

        try {
            const response = await fetch('/api/shipping/process', {
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
            
            // Mostrar detalles del envío
            shippingDetails.innerHTML = `
                <p class="mb-1"><strong>Número de Seguimiento:</strong> ${result.data.tracking_number}</p>
                <p class="mb-1"><strong>Costo de Envío:</strong> $${result.data.shipping_cost.toFixed(2)}</p>
                <p class="mb-1"><strong>Fecha Estimada de Entrega:</strong> ${result.data.estimated_delivery}</p>
                <p class="mb-1"><strong>Transportista:</strong> ${result.data.carrier}</p>
                <p class="mb-0"><strong>Estado:</strong> ${result.data.status}</p>
            `;
            shippingResult.classList.remove('d-none');
        } catch (error) {
            console.error('Error:', error);
            alert('Error al procesar el envío: ' + error.message);
        }
    });
});
</script>
@endpush
@endsection 