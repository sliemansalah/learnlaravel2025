@extends('layouts.app')

@section('title', 'Create Order - Validation Practice')

@section('content')
<div class="card">
    <h1>Place New Order</h1>
    <p style="color: #666; margin: 10px 0 20px;">Demonstrates nested array validation and conditional rules</p>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Please fix the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST" id="orderForm">
        @csrf

        <h3 style="margin: 20px 0; color: #333;">Order Items</h3>
        <p style="color: #666; margin-bottom: 15px;">Select at least one product</p>

        <div id="orderItems">
            @if(old('items'))
                @foreach(old('items') as $index => $item)
                    <div class="order-item" style="background: #f8f9fa; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                        <div style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 15px; align-items: start;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Product *</label>
                                <select name="items[{{ $index }}][product_id]" class="@error("items.{$index}.product_id") is-invalid @enderror">
                                    <option value="">-- Select Product --</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" {{ $item['product_id'] == $product->id ? 'selected' : '' }}>
                                            {{ $product->name }} - ${{ $product->price }}
                                        </option>
                                    @endforeach
                                </select>
                                @error("items.{$index}.product_id")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group" style="margin-bottom: 0;">
                                <label>Quantity *</label>
                                <input type="number" name="items[{{ $index }}][quantity]" value="{{ $item['quantity'] }}" min="1" class="@error("items.{$index}.quantity") is-invalid @enderror">
                                @error("items.{$index}.quantity")
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>

                            <button type="button" onclick="removeItem(this)" class="btn btn-danger" style="margin-top: 24px;">Remove</button>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="order-item" style="background: #f8f9fa; padding: 15px; margin-bottom: 15px; border-radius: 4px;">
                    <div style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 15px; align-items: start;">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Product *</label>
                            <select name="items[0][product_id]" class="@error('items.0.product_id') is-invalid @enderror">
                                <option value="">-- Select Product --</option>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group" style="margin-bottom: 0;">
                            <label>Quantity *</label>
                            <input type="number" name="items[0][quantity]" value="1" min="1">
                        </div>

                        <button type="button" onclick="removeItem(this)" class="btn btn-danger" style="margin-top: 24px;">Remove</button>
                    </div>
                </div>
            @endif
        </div>

        <button type="button" onclick="addItem()" class="btn btn-secondary" style="margin-bottom: 30px;">+ Add Another Item</button>

        <h3 style="margin: 30px 0 20px; color: #333; border-top: 2px solid #ddd; padding-top: 30px;">Payment Information</h3>

        {{-- Payment Method --}}
        <div class="form-group">
            <label>Payment Method *</label>
            <select name="payment_method" id="paymentMethod" class="@error('payment_method') is-invalid @enderror">
                <option value="">-- Select Payment Method --</option>
                <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>Cash</option>
                <option value="card" {{ old('payment_method') == 'card' ? 'selected' : '' }}>Credit/Debit Card</option>
                <option value="transfer" {{ old('payment_method') == 'transfer' ? 'selected' : '' }}>Bank Transfer</option>
            </select>
            @error('payment_method')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        {{-- Card Details (conditional) --}}
        <div id="cardDetails" style="display: none; background: #fff3cd; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <h4 style="margin-bottom: 15px; color: #856404;">Card Details</h4>

            <div class="form-group">
                <label for="card_number">Card Number * (16 digits)</label>
                <input
                    type="text"
                    name="card_number"
                    id="card_number"
                    value="{{ old('card_number') }}"
                    class="@error('card_number') is-invalid @enderror"
                    placeholder="1234567812345678"
                    maxlength="16"
                >
                @error('card_number')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="card_cvv">CVV * (3 digits)</label>
                <input
                    type="text"
                    name="card_cvv"
                    id="card_cvv"
                    value="{{ old('card_cvv') }}"
                    class="@error('card_cvv') is-invalid @enderror"
                    placeholder="123"
                    maxlength="3"
                    style="max-width: 150px;"
                >
                @error('card_cvv')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <h3 style="margin: 30px 0 20px; color: #333;">Shipping Information</h3>

        <div class="form-group">
            <label for="shipping_address">Shipping Address *</label>
            <textarea
                name="shipping_address"
                id="shipping_address"
                class="@error('shipping_address') is-invalid @enderror"
                placeholder="Enter your full shipping address"
                style="min-height: 80px;"
            >{{ old('shipping_address') }}</textarea>
            @error('shipping_address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 15px;">
            <div class="form-group">
                <label for="shipping_city">City *</label>
                <input
                    type="text"
                    name="shipping_city"
                    id="shipping_city"
                    value="{{ old('shipping_city') }}"
                    class="@error('shipping_city') is-invalid @enderror"
                    placeholder="City name"
                >
                @error('shipping_city')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="shipping_zip">ZIP Code * (5 digits)</label>
                <input
                    type="text"
                    name="shipping_zip"
                    id="shipping_zip"
                    value="{{ old('shipping_zip') }}"
                    class="@error('shipping_zip') is-invalid @enderror"
                    placeholder="12345"
                    maxlength="5"
                >
                @error('shipping_zip')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label for="notes">Order Notes (Optional)</label>
            <textarea
                name="notes"
                id="notes"
                class="@error('notes') is-invalid @enderror"
                placeholder="Any special instructions..."
                style="min-height: 80px;"
            >{{ old('notes') }}</textarea>
            @error('notes')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Place Order</button>
        <a href="{{ route('orders.index') }}" class="btn btn-secondary">Cancel</a>
    </form>

    <div class="info-box" style="margin-top: 30px;">
        <h3>Advanced Validation Features:</h3>
        <ul style="color: #666; font-size: 14px;">
            <li><strong>Nested Array Validation:</strong> Each order item is validated individually</li>
            <li><strong>Conditional Validation:</strong> Card details required only if payment method is "card"</li>
            <li><strong>Dynamic Form:</strong> Add/remove items using JavaScript</li>
            <li><strong>Relationship Checks:</strong> Products must exist in database</li>
            <li><strong>Complex Rules:</strong> Card number must be exactly 16 digits, CVV exactly 3 digits</li>
        </ul>
        <p style="margin-top: 15px; color: #1976D2; font-weight: bold;">
            💡 Try selecting "Credit/Debit Card" payment method - card fields become required!
        </p>
    </div>
</div>
@endsection

@section('scripts')
<script>
    let itemIndex = {{ old('items') ? count(old('items')) : 1 }};

    // Toggle card details based on payment method
    const paymentMethodSelect = document.getElementById('paymentMethod');
    const cardDetails = document.getElementById('cardDetails');

    function toggleCardDetails() {
        if (paymentMethodSelect.value === 'card') {
            cardDetails.style.display = 'block';
        } else {
            cardDetails.style.display = 'none';
        }
    }

    paymentMethodSelect.addEventListener('change', toggleCardDetails);
    toggleCardDetails(); // Initial state

    // Add new order item
    function addItem() {
        const itemsContainer = document.getElementById('orderItems');
        const newItem = document.createElement('div');
        newItem.className = 'order-item';
        newItem.style.cssText = 'background: #f8f9fa; padding: 15px; margin-bottom: 15px; border-radius: 4px;';

        newItem.innerHTML = `
            <div style="display: grid; grid-template-columns: 2fr 1fr auto; gap: 15px; align-items: start;">
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Product *</label>
                    <select name="items[${itemIndex}][product_id]">
                        <option value="">-- Select Product --</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }} - ${{ $product->price }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group" style="margin-bottom: 0;">
                    <label>Quantity *</label>
                    <input type="number" name="items[${itemIndex}][quantity]" value="1" min="1">
                </div>

                <button type="button" onclick="removeItem(this)" class="btn btn-danger" style="margin-top: 24px;">Remove</button>
            </div>
        `;

        itemsContainer.appendChild(newItem);
        itemIndex++;
    }

    // Remove order item
    function removeItem(button) {
        const items = document.querySelectorAll('.order-item');
        if (items.length > 1) {
            button.closest('.order-item').remove();
        } else {
            alert('You must have at least one item in your order.');
        }
    }
</script>
@endsection
