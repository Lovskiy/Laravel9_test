<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductCart;
use App\Models\User;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function OrderCreate(Request $request)
    {
        $token = $request->bearerToken();

        $user = User::where('user_token', '=', $token)->first();
        $productCart = ProductCart::where('user_id', '=', $user->id)->get();
//        $productPrice = Product::where('id', '=', $productCart->product_id)->first();

        $orderCreate = Order::create([
            'product_id' => implode($productCart->product_id),
            'price' => 200
        ]);

        return response()->json([
            'data' => [
                $orderCreate
            ]
        ], 200);
    }
}
