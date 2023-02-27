<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCart;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\ProductCardResource;

class CartController extends Controller
{

    public function addCart(Request $request, int $id)
    {
        $token = $request->bearerToken();

        $user = User::where('user_token', '=', $token)->first();
        $product = Product::where('id', '=', $id)->first();

        if (!$product) {
            return response()->json([
                'data' => [
                    'message' => 'Product not found'
                ]
            ]);
        }

        $productCart = ProductCart::create([
            'user_id' => $user->id,
            'product_id' => $id
        ]);

        return response()->json([
            'data' => [
                'message' => 'Product add to card'
            ]
        ],
            201
        );
    }

    public function showCart(Request $request)
    {
        $user = User::where('user_token', $request->bearerToken())->first();

        $products = ProductCart::where('user_id', $user->id)->get();
        return ProductCardResource::collection($products);
    }


    public function destroyCart(Request $request, int $id)
    {
        $cart = ProductCart::where('id', $id)->first();
        if (!$cart) return response()->json([
            'data' => [
                'message' => 'Cart not found'
            ]
        ], 403);

        $user = User::where('user_token', $request->bearerToken())->first();
        if ($user->id != $cart->user_id) {
            return response()->json(
                [
                    'error' => [
                        'code' => 403,
                        'message' => 'Forbidden for you'
                    ]
                ], 403
            );
        }

        if (ProductCart::destroy($id)) {
            return response()->json(
                [
                    'data' => [
                        'message' => 'Item removed from cart'
                    ]
                ], 200
            );
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

}
