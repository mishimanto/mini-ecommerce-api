<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    // Get User Orders (search + pagination)
    public function index(Request $request)
    {
        $search = $request->query('search');

        $orders = Order::where('user_id', auth()->id())
            ->when($search, function ($q) use ($search) {
                $q->where('id', $search);   // exact match only
            })
            ->with('items')
            ->paginate(5);


        return response()->json($orders);
    }
    // Store Order 
    public function store(Request $request)
    {
        $request->validate([
            'items'=>'required|array',
            'items.*.product_id'=>'required|exists:products,id',
            'items.*.quantity'=>'required|integer|min:1'
        ]);

        $total = 0;

        foreach($request->items as $item){
            $product = Product::find($item['product_id']);
            $total += $product->price * $item['quantity'];
        }

        $order = Order::create([
            'user_id'=>auth()->id(),
            'total'=>$total
        ]);

        foreach($request->items as $item){
            $product = Product::find($item['product_id']);

            OrderItem::create([
                'order_id'=>$order->id,
                'product_id'=>$product->id,
                'quantity'=>$item['quantity'],
                'price'=>$product->price
            ]);
        }

        return response()->json([
            'message'=>'Order placed successfully',
            'order'=>$order->load('items')
        ]);
    }
}
