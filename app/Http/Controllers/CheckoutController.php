<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CheckoutController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $itemTotal = ($product->sale_price ?? $product->price) * $quantity;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];
                $total += $itemTotal;
            }
        }

        return view('frontend.checkout', compact('cartItems', 'total'));
    }

    public function process(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_email' => 'required|email|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_address' => 'nullable|string|max:500',
            'notes' => 'nullable|string|max:1000',
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $subtotal = 0;
        $orderItems = [];

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $price = $product->sale_price ?? $product->price;
                $itemTotal = $price * $quantity;

                $orderItems[] = [
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'product_price' => $price,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];

                $subtotal += $itemTotal;
            }
        }

        // Create order
        $order = Order::create([
            'customer_name' => $validated['customer_name'],
            'customer_email' => $validated['customer_email'],
            'customer_phone' => $validated['customer_phone'],
            'customer_address' => $validated['customer_address'],
            'subtotal' => $subtotal,
            'total' => $subtotal,
            'notes' => $validated['notes'],
            'status' => 'pending',
        ]);

        // Create order items
        foreach ($orderItems as $item) {
            $order->items()->create($item);
        }

        // Clear cart
        session()->forget('cart');

        // Store order in session for invoice
        session()->put('last_order_id', $order->id);

        return redirect()->route('checkout.complete', $order);
    }

    public function complete(Order $order)
    {
        $order->load('items');
        $whatsappNumber = Setting::get('whatsapp_number', '+2348034966505');

        // Build WhatsApp message
        $message = "Hello! I'd like to complete my order.\n\n";
        $message .= "*Order #: {$order->order_number}*\n";
        $message .= "Name: {$order->customer_name}\n";
        $message .= "Phone: {$order->customer_phone}\n\n";
        $message .= "*Order Details:*\n";

        foreach ($order->items as $item) {
            $message .= "- {$item->product_name} x {$item->quantity} = ₦" . number_format($item->total, 2) . "\n";
        }

        $message .= "\n*Total: ₦" . number_format($order->total, 2) . "*\n";

        if ($order->customer_address) {
            $message .= "\nDelivery Address: {$order->customer_address}";
        }

        $whatsappUrl = "https://wa.me/" . preg_replace('/[^0-9]/', '', $whatsappNumber) . "?text=" . urlencode($message);

        return view('frontend.checkout-complete', compact('order', 'whatsappUrl'));
    }

    public function downloadInvoice(Order $order)
    {
        $order->load('items');

        $pdf = Pdf::loadView('pdf.invoice', [
            'order' => $order,
            'siteName' => Setting::get('site_name', 'C-Nuel Medicine and Store'),
        ]);

        return $pdf->download("invoice-{$order->order_number}.pdf");
    }
}
