<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = session()->get('cart', []);
        $cartItems = [];
        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $price = $product->sale_price ?? $product->price;
                $itemTotal = $price * $quantity;
                $cartItems[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'total' => $itemTotal,
                ];
                $total += $itemTotal;
            }
        }

        // Return JSON for cart drawer AJAX requests
        if ($request->ajax() || $request->wantsJson()) {
            $drawerItems = array_map(function ($item) {
                return [
                    'id' => $item['product']->id,
                    'name' => $item['product']->name,
                    'price' => number_format($item['product']->sale_price ?? $item['product']->price, 2),
                    'quantity' => $item['quantity'],
                    'total' => number_format($item['total'], 2),
                    'image' => $item['product']->image ? asset('storage/' . $item['product']->image) : null,
                    'slug' => $item['product']->slug,
                ];
            }, $cartItems);

            return response()->json([
                'cartItems' => $drawerItems,
                'total' => number_format($total, 2),
                'count' => array_sum($cart),
            ]);
        }

        return view('frontend.cart', compact('cartItems', 'total'));
    }

    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'integer|min:1|max:100',
        ]);

        $quantity = $request->input('quantity', 1);
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] += $quantity;
        } else {
            $cart[$product->id] = $quantity;
        }

        session()->put('cart', $cart);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product added to cart!',
                'cartCount' => array_sum($cart),
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1|max:100',
        ]);

        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            $cart[$product->id] = $request->quantity;
            session()->put('cart', $cart);
        }

        $total = 0;
        foreach ($cart as $pId => $qty) {
            $p = Product::find($pId);
            if ($p) $total += ($p->sale_price ?? $p->price) * $qty;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Cart updated!',
                'cartCount' => array_sum($cart),
                'total' => number_format($total, 2),
            ]);
        }

        return redirect()->back()->with('success', 'Cart updated!');
    }

    public function remove(Request $request, Product $product)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$product->id])) {
            unset($cart[$product->id]);
            session()->put('cart', $cart);
        }

        $total = 0;
        foreach ($cart as $pId => $qty) {
            $p = Product::find($pId);
            if ($p) $total += ($p->sale_price ?? $p->price) * $qty;
        }

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Product removed from cart!',
                'cartCount' => array_sum($cart),
                'total' => number_format($total, 2),
            ]);
        }

        return redirect()->back()->with('success', 'Product removed from cart!');
    }

    public function clear()
    {
        session()->forget('cart');
        return redirect()->back()->with('success', 'Cart cleared!');
    }

    public function getCount()
    {
        $cart = session()->get('cart', []);
        return response()->json(['count' => array_sum($cart)]);
    }
}
