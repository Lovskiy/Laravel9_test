<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCardResource;
use App\Models\Order;
use App\Models\Orders;
use App\Models\ProductCart;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function OrderCreate(Request $request)
    {
        $user = User::where('user_token', $request->bearerToken())->first();
        $products = ProductCart::where('user_id', $user->id)->get();
        $ordersInput = Orders::all();
        $p_order = Order::all();
//        return implode([$products->product_id]);


//        Other
        foreach ($products as $item_test) {
            foreach ($ordersInput as $item) {
                $orders = Orders::create([
                    'user_id' => $user->id
                ]);

                Order::create([
                    'product_id' => $item_test['product_id'],
                    'order_id' => $item['id'],
                    'price' => 400
                ]);

                return response()->json([
                    'data' => [
                        $item_test->product_id
                    ]
                ]);
            }
        }

//        return response()->json([
//            'data' => [
////                'id' => $p_order->id,
////                'products' => $p_order->product_id,
////                'order_price' => $p_order->price
//            ]
//        ]);
//
//        $order = Order::create([
//            'product_id' => 2,
//            'order_id' => $orders->id,
//            'price' => 400
//        ]);
    }

    public function OrderList()
    {
        return Order::all();
    }
}
