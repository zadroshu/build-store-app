<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\ProductOrder;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return json
     */
    public function getOrders()
    {
      $orders = Order::all();
      $ordersProducts = [];
      foreach ($orders as $order) {
        array_push($ordersProducts, ['id' => $order->id, 'phone' => $order->phone, 'email' => $order->email,  'products' => $order->products]);
      };
      return response()->json($ordersProducts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
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
     * Update the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function update(Request $request)
    {
      $order = Order::find($request->all()['id']);
      $order->email = $request->all()['email'];
      $order->phone = $request->all()['phone'];

      foreach ($order->products as $stoerdProduct) {
        $searchResult = array_search($stoerdProduct['id'], array_column($request->all()['products'], 'id'));
        if ($searchResult !== false) {
          ProductOrder::where([
            ['product_id', '=', $stoerdProduct['id']],
            ['order_id', '=', $stoerdProduct['pivot']['order_id']],
          ])->update(array('quantity' => $request->all()['products'][$searchResult]['pivot']['quantity']));
        } else {
          ProductOrder::where([
            ['product_id', '=', $stoerdProduct['id']],
            ['order_id', '=', $stoerdProduct['pivot']['order_id']],
          ])->delete();
        }
      }

      $order->save();
    }

    /**
     * Delete the specified resource from storage.
     *
     * @param int $id
     * @return json
     */
    public function delete(int $id)
    {
      return response()->json(Order::find($id)->delete());
    }
}
