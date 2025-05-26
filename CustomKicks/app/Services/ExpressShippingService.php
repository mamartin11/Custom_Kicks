<?php

namespace App\Services;

use App\Interfaces\ShippingServiceInterface;
use App\Models\Order;

class ExpressShippingService implements ShippingServiceInterface
{
    // Porcentaje del valor de la orden para el costo base (mayor que el estándar)
    private const ORDER_VALUE_PERCENTAGE = 0.08; // 8% del valor de la orden
    // Costo mínimo de envío express
    private const MINIMUM_SHIPPING_COST = 25.00;
    // Factor de costo por distancia (mayor que el estándar)
    private const DISTANCE_FACTOR = 0.05;

    public function calculateShippingCost(array $orderData): float
    {
        $orderTotal = $orderData['order_total'] ?? 0;
        $distance = $orderData['distance'] ?? 0;
        
        // Calculamos el costo base basado en el valor de la orden
        $baseCost = max(
            self::MINIMUM_SHIPPING_COST,
            $orderTotal * self::ORDER_VALUE_PERCENTAGE
        );
        
        // Agregamos el costo por distancia
        $distanceCost = $distance * self::DISTANCE_FACTOR;
        
        return $baseCost + $distanceCost;
    }

    public function generateTrackingNumber(): string
    {
        return 'EXP-' . strtoupper(uniqid());
    }

    public function processShipping(array $orderData): array
    {
        $trackingNumber = $this->generateTrackingNumber();
        $shippingCost = $this->calculateShippingCost($orderData);

        return [
            'tracking_number' => $trackingNumber,
            'shipping_cost' => $shippingCost,
            'estimated_delivery' => now()->addDays(2)->format('Y-m-d'),
            'carrier' => 'Express Shipping',
            'status' => 'processing',
            'priority' => 'high',
            'shipping_type' => 'express',
            'order_total' => $orderData['order_total'] ?? 0,
            'distance' => $orderData['distance'] ?? 0
        ];
    }

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