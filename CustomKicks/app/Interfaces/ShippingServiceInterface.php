<?php

namespace App\Interfaces;

interface ShippingServiceInterface
{
    /**
     * Calculate the shipping cost for an order
     */
    public function calculateShippingCost(array $orderData): float;

    /**
     * Generate a tracking number for the shipment
     */
    public function generateTrackingNumber(): string;

    /**
     * Process the shipping of an order
     */
    public function processShipping(array $orderData): array;

    /**
     * Get the total order amount
     */
    public function getOrderTotal(string $orderId): float;

    /**
     * Get the order discount
     */
    public function getOrderDiscount(string $orderId): int;
}
