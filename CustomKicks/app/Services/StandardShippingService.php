<?php

namespace App\Services;

use App\Interfaces\ShippingServiceInterface;
use App\Models\Order;

class StandardShippingService implements ShippingServiceInterface
{
    // Porcentaje del valor de la orden para el costo base
    private const ORDER_VALUE_PERCENTAGE = 0.05; // 5% del valor de la orden
    // Costo mínimo de envío
    private const MINIMUM_SHIPPING_COST = 10.00;
    // Factor de costo por distancia
    private const DISTANCE_FACTOR = 0.02; // Reducido de 0.50 a 0.25 por kilómetro

    public function calculateShippingCost(array $orderData): float
    {
        $orderTotal = $orderData['order_total'] ?? 0;
        $distance = $orderData['distance'] ?? 0;
        $shippingType = $orderData['shipping_type'] ?? 'standard';
        
        // Costos base según el tipo de envío
        $baseCost = $shippingType === 'express' ? 25.00 : 10.00;
        $distanceFactor = $shippingType === 'express' ? 1.5 : 0.02;
        
        // Calculamos el costo base basado en el valor de la orden
        $baseCost = max(
            $baseCost,
            $orderTotal * self::ORDER_VALUE_PERCENTAGE
        );
        
        // Agregamos el costo por distancia
        $distanceCost = $distance * $distanceFactor;
        
        return $baseCost + $distanceCost;
    }

    public function generateTrackingNumber(): string
    {
        return 'STD-' . strtoupper(uniqid());
    }

    public function processShipping(array $orderData): array
    {
        $trackingNumber = $this->generateTrackingNumber();
        $shippingCost = $this->calculateShippingCost($orderData);
        $shippingType = $orderData['shipping_type'] ?? 'standard';

        return [
            'tracking_number' => $trackingNumber,
            'shipping_cost' => $shippingCost,
            'estimated_delivery' => $shippingType === 'express' ? 
                now()->addDays(2)->format('Y-m-d') : 
                now()->addDays(5)->format('Y-m-d'),
            'carrier' => $shippingType === 'express' ? 'Express Shipping' : 'Standard Shipping',
            'status' => 'processing',
            'shipping_type' => $shippingType,
            'order_total' => $orderData['order_total'] ?? 0,
            'distance' => $orderData['distance'] ?? 0
        ];
    }

    /**
     * Get the total order amount
     *
     * @param string $orderId
     * @return float
     */
    public function getOrderTotal(string $orderId): float
    {
        $order = Order::find($orderId);
        return $order ? $order->getTotal() : 0.00;
    }

    public function getOrderDiscount(string $orderId): int
    {
        $discountValues = [0, 10, 20, 50];
        return $discountValues[array_rand($discountValues)];
    }
} 