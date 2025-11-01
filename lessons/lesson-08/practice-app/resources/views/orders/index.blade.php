@extends('layouts.app')

@section('title', 'Orders List - Validation Practice')

@section('content')
<div class="card">
    <h1>All Orders</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @auth
        <a href="{{ route('orders.create') }}" class="btn btn-primary" style="margin: 20px 0;">+ Place New Order</a>
    @else
        <div class="alert alert-danger" style="margin: 20px 0;">
            Please log in to place orders. (Authentication required)
        </div>
    @endauth

    @if($orders->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Total Amount</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td><strong>#{{ $order->id }}</strong></td>
                        <td>{{ $order->user->name }}</td>
                        <td>
                            {{ $order->items->count() }} item(s)
                            <br>
                            <small style="color: #666;">
                                @foreach($order->items as $item)
                                    {{ $item->product->name }} (x{{ $item->quantity }}){{ !$loop->last ? ', ' : '' }}
                                @endforeach
                            </small>
                        </td>
                        <td><strong>${{ number_format($order->total_amount, 2) }}</strong></td>
                        <td>{{ ucfirst($order->payment_method) }}</td>
                        <td>
                            @if($order->status === 'completed')
                                <span class="badge badge-success">Completed</span>
                            @elseif($order->status === 'processing')
                                <span class="badge" style="background: #cfe2ff; color: #084298;">Processing</span>
                            @else
                                <span class="badge badge-warning">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div style="margin-top: 20px;">
            {{ $orders->links() }}
        </div>
    @else
        <div style="padding: 40px; text-align: center; background: #f8f9fa; border-radius: 4px; margin-top: 20px;">
            <h3 style="color: #666; margin-bottom: 10px;">No orders yet!</h3>
            <p style="color: #999;">Place your first order to get started.</p>
        </div>
    @endif

    <div class="info-box" style="margin-top: 30px;">
        <h3>About Order Validation</h3>
        <p style="margin: 10px 0; line-height: 1.6; color: #555;">
            The order form demonstrates complex validation scenarios:
        </p>
        <ul style="color: #666;">
            <li><strong>Nested Array Validation:</strong> Each order item has its own validation rules</li>
            <li><strong>Dynamic Validation:</strong> Rules change based on payment method selected</li>
            <li><strong>Conditional Fields:</strong> Card details only required for card payments</li>
            <li><strong>Business Logic:</strong> Total amount calculated from validated items</li>
            <li><strong>Relational Integrity:</strong> Products must exist and be in stock</li>
        </ul>
    </div>
</div>
@endsection
