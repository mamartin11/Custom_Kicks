<?php
// Jacobo Restrepo
namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Create a new controller instance.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Process checkout and create a new order
     */
    public function checkout(): View|RedirectResponse
    {
        $cartItems = session()->get('cart_items', []);
        
        // Check if cart is empty
        if (empty($cartItems)) {
            return redirect()->route('cart.list')
                ->with('error', 'Your cart is empty. Please add items before checkout.');
        }
        
        $total = array_sum(array_column($cartItems, 'subtotal'));
        $userBudget = Auth::user()->budget ?? 0;
        $remainingBudget = $userBudget - $total;

        $order = new Order;
        $order->setTotal($total);
        $order->setOrderDate(now()->toDateString());
        $order->user_id = Auth::user()->id;
        $order->setDetails($cartItems);
        $order->save();
        
        // Clear the cart after successful order
        session()->forget('cart_items');

        return view('order.checkout', [
            'title' => 'Order Summary',
            'items' => $cartItems,
            'total' => $total,
            'userBudget' => $userBudget,
            'remainingBudget' => $remainingBudget,
        ]);
    }

    /**
     * List orders for the authenticated user
     */
    public function myOrders(): View
    {
        $user = Auth::user();
        $orders = $user->orders()->orderBy('created_at', 'desc')->get();
        
        return view('order.my-orders', [
            'orders' => $orders,
        ]);
    }

    /**
     * Display the admin orders dashboard
     */
    public function index(): View
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para acceder a esta sección.');
        }

        $orders = Order::with(['user', 'items'])->orderBy('created_at', 'desc')->get();
        return view('order.index', [
            'title' => 'Gestión de Órdenes',
            'orders' => $orders
        ]);
    }

    /**
     * Mark an order as completed
     */
    public function complete(Order $order): RedirectResponse
    {
        if (!auth()->check() || auth()->user()->role !== 'admin') {
            abort(403, 'No tienes permisos para realizar esta acción.');
        }
        $order->markAsCompleted();
        return redirect()->route('admin.orders.dashboard')->with('success', 'Orden marcada como completada');
    }
}
