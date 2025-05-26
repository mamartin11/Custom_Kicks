<?php

namespace App\Http\Controllers;

use App\Interfaces\ShippingServiceInterface;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ShippingController extends Controller
{
    private ShippingServiceInterface $shippingService;

    public function __construct(ShippingServiceInterface $shippingService)
    {
        $this->shippingService = $shippingService;
    }

    /**
     * Calculate shipping cost for an order
     */
    public function calculateCost(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|string',
            'order_total' => 'required|numeric|min:0',
            'distance' => 'required|numeric|min:0',
            'shipping_type' => 'required|in:standard,express'
        ]);

        $cost = $this->shippingService->calculateShippingCost($validated);

        return response()->json([
            'shipping_cost' => $cost,
            'shipping_type' => $validated['shipping_type'],
            'estimated_delivery' => $validated['shipping_type'] === 'express' ? 
                now()->addDays(2)->format('Y-m-d') : 
                now()->addDays(5)->format('Y-m-d')
        ]);
    }

    public function confirmShippingType(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|string',
            'shipping_type' => 'required|in:standard,express'
        ]);

        $order = Order::find($validated['order_id']);
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        $order->setShippingType($validated['shipping_type']);
        $order->save();

        return response()->json([
            'message' => 'Shipping type confirmed successfully',
            'shipping_type' => $validated['shipping_type']
        ]);
    }

    /**
     * Process shipping for an order
     */
    public function processShipping(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'order_id' => 'required|string',
            'order_total' => 'required|numeric|min:0',
            'distance' => 'required|numeric|min:0',
            'shipping_type' => 'required|in:standard,express',
            'address' => 'required|array',
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.country' => 'required|string',
        ]);

        $shippingDetails = $this->shippingService->processShipping($validated);

        // Actualizar el tipo de envío en la base de datos
        $order = Order::find($validated['order_id']);
        if ($order) {
            $order->setShippingType($validated['shipping_type']);
            $order->save();
        }

        return response()->json([
            'message' => 'Shipping processed successfully',
            'data' => $shippingDetails
        ]);
    }

    /**
     * Muestra la vista de seguimiento de pedidos
     */
    public function showTracking()
    {
        return view('order.tracking');
    }

    /**
     * Obtiene la información de seguimiento de un pedido
     */
    public function getTrackingInfo(string $orderId): JsonResponse
    {
        $order = Order::find($orderId);
        
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        return response()->json([
            'order_id' => $orderId,
            'order_date' => $order->getOrderDate(),
            'total' => $order->getTotal(),
            'discount' => $this->shippingService->getOrderDiscount($orderId),
            'shipping_type' => $order->getShippingType(),
            'status_dates' => [
                'confirmed' => now()->format('Y-m-d H:i:s'),
                'preparation' => now()->addHours(2)->format('Y-m-d H:i:s'),
                'transit' => null,
                'delivery' => null
            ]
        ]);
    }
} 