<?php

namespace App\Interfaces;

interface ShippingServiceInterface
{
    /**
     * Calculate the shipping cost for an order
     *
     * @param array $orderData
     * @return float
     */
    public function calculateShippingCost(array $orderData): float;

    /**
     * Generate a tracking number for the shipment
     *
     * @return string
     */
    public function generateTrackingNumber(): string;

    /**
     * Process the shipping of an order
     *
     * @param array $orderData
     * @return array
     */
    public function processShipping(array $orderData): array;

    /**
     * Get the total order amount
     *
     * @param string $orderId
     * @return float
     */
    public function getOrderTotal(string $orderId): float;

    /**
     * Get the order discount
     *
     * @param string $orderId
     * @return int
     */
    public function getOrderDiscount(string $orderId): int;
} 