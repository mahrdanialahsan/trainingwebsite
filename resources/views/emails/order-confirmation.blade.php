<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #2e3a47;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
        }
        .order-details {
            background-color: white;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #2e3a47;
        }
        .detail-row {
            margin: 10px 0;
            padding: 8px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-row:last-child {
            border-bottom: none;
        }
        .detail-label {
            font-weight: bold;
            color: #2e3a47;
            display: inline-block;
            width: 150px;
        }
        .product-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: white;
        }
        .product-table th {
            background-color: #2e3a47;
            color: white;
            padding: 12px;
            text-align: left;
        }
        .product-table td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }
        .product-table tr:last-child td {
            border-bottom: none;
        }
        .total-row {
            background-color: #f0f0f0;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #2e3a47;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 10px 5px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Order Confirmed!</h1>
    </div>
    
    <div class="content">
        <p>Dear {{ $order->first_name }},</p>
        
        <p>Thank you for your order! We've received your payment and are processing your order.</p>
        
        <div class="order-details">
            <h2 style="color: #2e3a47; margin-top: 0;">Order Details</h2>
            
            <div class="detail-row">
                <span class="detail-label">Order ID:</span>
                <span>#{{ $order->id }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Order Date:</span>
                <span>{{ $order->created_at->format('F d, Y g:i A') }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Customer Name:</span>
                <span>{{ $order->first_name }} {{ $order->last_name }}</span>
            </div>
            
            <div class="detail-row">
                <span class="detail-label">Email:</span>
                <span>{{ $order->email }}</span>
            </div>
            
            @if($order->phone)
            <div class="detail-row">
                <span class="detail-label">Phone:</span>
                <span>{{ $order->phone }}</span>
            </div>
            @endif
            
            @if($order->address)
            <div class="detail-row">
                <span class="detail-label">Shipping Address:</span>
                <span>{{ $order->address }}</span>
            </div>
            @endif
            
            <div class="detail-row">
                <span class="detail-label">Payment Status:</span>
                <span style="color: #22c55e; font-weight: bold;">{{ ucfirst($order->status) }}</span>
            </div>
        </div>
        
        <h3 style="color: #2e3a47;">Order Items</h3>
        <table class="product-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th style="text-align: center;">Quantity</th>
                    <th style="text-align: right;">Price</th>
                    <th style="text-align: right;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_title }}</td>
                    <td style="text-align: center;">{{ $item->quantity }}</td>
                    <td style="text-align: right;">${{ number_format($item->price, 2) }}</td>
                    <td style="text-align: right;">${{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
                <tr class="total-row">
                    <td colspan="3" style="text-align: right;">Subtotal:</td>
                    <td style="text-align: right;">${{ number_format($order->subtotal, 2) }}</td>
                </tr>
                <tr class="total-row">
                    <td colspan="3" style="text-align: right; font-size: 1.1em;">Total:</td>
                    <td style="text-align: right; font-size: 1.1em;">${{ number_format($order->total, 2) }}</td>
                </tr>
            </tbody>
        </table>
        
        <p>Your order will be processed and shipped shortly. We'll send you another email with tracking information once your order ships.</p>
        
        <p>If you have any questions about your order, please don't hesitate to contact us.</p>
        
        @auth
        <p style="margin-top: 30px;">
            <a href="{{ route('dashboard', ['tab' => 'orders']) }}" class="button">View My Orders</a>
        </p>
        @endauth
    </div>
    
    <div class="footer">
        <p>Thank you for shopping with Texas Training Group!</p>
        <p>This is an automated email. Please do not reply to this message.</p>
    </div>
</body>
</html>
