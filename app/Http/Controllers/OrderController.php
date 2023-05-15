<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $order = new Order(['email' => $request->all()['email'], 'phone' => $request->all()['phone']]);
            $order->save();

            $cart = $request->all()['cart'];
            foreach ($cart as $cartItem) {
                $productOrderData = [];
                $productOrderData['product_id'] = $cartItem['product']['id'];
                $productOrderData['order_id'] = $order->id;
                $productOrderData['quantity'] = $cartItem['quantity'];
                $productOrder = new ProductOrder($productOrderData);
                $productOrder->save();
        };
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
      //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
      //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
      //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
      //
    }
}
