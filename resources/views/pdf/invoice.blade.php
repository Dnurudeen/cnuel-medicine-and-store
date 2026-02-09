<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Invoice #{{ $order->order_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #333;
        }

        .invoice-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 30px;
        }

        .header {
            display: table;
            width: 100%;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 20px;
        }

        .header-left {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .header-right {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            text-align: right;
        }

        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #2563eb;
            margin-bottom: 5px;
        }

        .company-tagline {
            font-size: 12px;
            color: #666;
        }

        .invoice-title {
            font-size: 28px;
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .invoice-number {
            font-size: 14px;
            color: #666;
        }

        .invoice-date {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }

        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .info-box {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }

        .info-box-title {
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
            color: #666;
            margin-bottom: 10px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .info-content {
            font-size: 12px;
        }

        .info-content p {
            margin-bottom: 3px;
        }

        .info-content strong {
            color: #333;
        }

        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        .items-table th {
            background-color: #2563eb;
            color: white;
            padding: 12px 10px;
            text-align: left;
            font-size: 11px;
            text-transform: uppercase;
        }

        .items-table th:last-child,
        .items-table td:last-child {
            text-align: right;
        }

        .items-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
        }

        .items-table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .product-name {
            font-weight: bold;
            color: #333;
        }

        .totals-section {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }

        .totals-left {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }

        .totals-right {
            display: table-cell;
            width: 40%;
            vertical-align: top;
        }

        .totals-table {
            width: 100%;
            border-collapse: collapse;
        }

        .totals-table td {
            padding: 8px 10px;
            border-bottom: 1px solid #eee;
        }

        .totals-table td:last-child {
            text-align: right;
            font-weight: bold;
        }

        .totals-table tr:last-child td {
            background-color: #2563eb;
            color: white;
            font-size: 14px;
            border: none;
        }

        .payment-info {
            background-color: #f0f9ff;
            border: 1px solid #bae6fd;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 30px;
        }

        .payment-info-title {
            font-weight: bold;
            color: #0369a1;
            margin-bottom: 10px;
        }

        .payment-info p {
            margin-bottom: 5px;
            font-size: 11px;
        }

        .notes-section {
            background-color: #fef3c7;
            border: 1px solid #fcd34d;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 30px;
        }

        .notes-title {
            font-weight: bold;
            color: #92400e;
            margin-bottom: 10px;
        }

        .notes-content {
            font-size: 11px;
            color: #78350f;
        }

        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 11px;
        }

        .footer p {
            margin-bottom: 5px;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .status-pending {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-processing {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-completed {
            background-color: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .whatsapp-note {
            background-color: #dcfce7;
            border: 1px solid #86efac;
            border-radius: 5px;
            padding: 15px;
            text-align: center;
            margin-bottom: 20px;
        }

        .whatsapp-note p {
            color: #166534;
            font-size: 12px;
        }

        .whatsapp-number {
            font-size: 16px;
            font-weight: bold;
            color: #15803d;
        }
    </style>
</head>

<body>
    <div class="invoice-container">
        <!-- Header -->
        <div class="header">
            <div class="header-left">
                <div class="company-name">C-Nuel Medicine and Store</div>
                <div class="company-tagline">Your Health, Our Priority</div>
            </div>
            <div class="header-right">
                <div class="invoice-title">INVOICE</div>
                <div class="invoice-number">#{{ $order->order_number }}</div>
                <div class="invoice-date">Date: {{ $order->created_at->format('F d, Y') }}</div>
                <div style="margin-top: 10px;">
                    <span class="status-badge status-{{ $order->status }}">{{ ucfirst($order->status) }}</span>
                </div>
            </div>
        </div>

        <!-- Customer & Order Info -->
        <div class="info-section">
            <div class="info-box">
                <div class="info-box-title">Bill To</div>
                <div class="info-content">
                    <p><strong>{{ $order->customer_name }}</strong></p>
                    <p>{{ $order->customer_email }}</p>
                    <p>{{ $order->customer_phone }}</p>
                    <p>{{ $order->customer_address }}</p>
                </div>
            </div>
            <div class="info-box" style="text-align: right;">
                <div class="info-box-title">Order Details</div>
                <div class="info-content">
                    <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                    <p><strong>Order Date:</strong> {{ $order->created_at->format('M d, Y h:i A') }}</p>
                    <p><strong>Payment Method:</strong> WhatsApp</p>
                    <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                </div>
            </div>
        </div>

        <!-- Order Items -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 10%;">#</th>
                    <th style="width: 40%;">Product</th>
                    <th style="width: 15%;">Price</th>
                    <th style="width: 15%;">Quantity</th>
                    <th style="width: 20%;">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <span class="product-name">{{ $item->product_name }}</span>
                        </td>
                        <td>₦{{ number_format($item->price, 2) }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₦{{ number_format($item->subtotal, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Totals -->
        <div class="totals-section">
            <div class="totals-left">
                <!-- WhatsApp Payment Note -->
                <div class="whatsapp-note">
                    <p>Complete your payment via WhatsApp:</p>
                    <p class="whatsapp-number">+2348034966505</p>
                    <p style="margin-top: 5px; font-size: 11px;">Send this invoice reference:
                        <strong>{{ $order->order_number }}</strong></p>
                </div>
            </div>
            <div class="totals-right">
                <table class="totals-table">
                    <tr>
                        <td>Subtotal:</td>
                        <td>₦{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                    <tr>
                        <td>Shipping:</td>
                        <td>To be confirmed</td>
                    </tr>
                    <tr>
                        <td>Total:</td>
                        <td>₦{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if ($order->notes)
            <!-- Notes -->
            <div class="notes-section">
                <div class="notes-title">Order Notes</div>
                <div class="notes-content">{{ $order->notes }}</div>
            </div>
        @endif

        <!-- Payment Info -->
        <div class="payment-info">
            <div class="payment-info-title">Payment Instructions</div>
            <p>1. Save this invoice for your records.</p>
            <p>2. Contact us on WhatsApp at <strong>+2348034966505</strong> to complete your payment.</p>
            <p>3. Reference your order number <strong>{{ $order->order_number }}</strong> when making payment.</p>
            <p>4. Once payment is confirmed, your order will be processed and shipped.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>C-Nuel Medicine and Store</strong></p>
            <p>Thank you for your business!</p>
            <p>For any inquiries, contact us at: +2348034966505</p>
            <p style="margin-top: 10px; font-size: 10px; color: #999;">
                This invoice was generated on {{ now()->format('F d, Y \a\t h:i A') }}
            </p>
        </div>
    </div>
</body>

</html>
