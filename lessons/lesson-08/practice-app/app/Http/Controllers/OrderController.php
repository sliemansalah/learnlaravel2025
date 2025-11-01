<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderRequest;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->paginate(10);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $products = Product::where('stock', '>', 0)->get();
        return view('orders.create', compact('products'));
    }

    public function store(StoreOrderRequest $request)
    {
        $validated = $request->validated();

        // Calculate total amount
        $totalAmount = 0;
        $items = [];

        foreach ($validated['items'] as $item) {
            $product = Product::find($item['product_id']);
            $price = $product->price;
            $totalAmount += $price * $item['quantity'];

            $items[] = [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $price,
            ];
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'payment_method' => $validated['payment_method'],
            'card_number' => $validated['card_number'] ?? null,
            'card_cvv' => $validated['card_cvv'] ?? null,
            'shipping_address' => $validated['shipping_address'],
            'shipping_city' => $validated['shipping_city'],
            'shipping_zip' => $validated['shipping_zip'],
            'notes' => $validated['notes'] ?? null,
            'total_amount' => $totalAmount,
        ]);

        // Create order items
        foreach ($items as $item) {
            $order->items()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Order placed successfully');
    }

    public function show(Order $order)
    {
        $order->load(['user', 'items.product']);
        return view('orders.show', compact('order'));
    }
}
