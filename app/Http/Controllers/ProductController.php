<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use Inertia\Inertia;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(12));
  
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $validate = $request->validate([
        'name' => 'required|string|max:191',
        'category' => 'required|int',
        'cost' => 'required|int',
        'discount' => 'required|int',
        'description' => 'required|string|max:1000',
        'images' => 'nullable|string|max:255',
        'in_stock' => 'required|int',
      ]);

      $product = new Product($validate);
      $product->save();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

      $validated = $request->validate([
        'name' => 'required|string|max:191',
        'category' => 'required|int',
        'cost' => 'required|int',
        'discount' => 'required|int',
        'description' => 'required|string|max:1000',
        'images' => 'nullable|string|max:255',
        'in_stock' => 'required|int',
      ]);

      $product->update($validated);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
      //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, int $id)
    {
      return response()->json(\App\Models\Product::find($id));
      
    }

    public function addToCart(Request $request, $id)
    {
      $product = Product::findOrFail($id);
      $oldCart = session()->has('cart') ? session()->get('cart') : null;
      $cart = new Cart($oldCart);
      $cart->add($product, $product->id);

      $request->session()->put('cart', $cart);

      return $request->session()->get('cart');
    }

    public function getCart()
    {
      $cart = session()->get('cart', []);
      $keys = array_keys($cart);

      $products = Product::findMany($keys);

      return Inertia::render('Store/Cart', [
        'products' => $products,
      ]);
    }

    public function deleteFromCart(Request $request, $id)
    {
      $cart = $request->session()->get('cart', []);

      foreach ( $cart as $item ) {
        if (array_key_exists('product_id', $item) and $item['product_id'] == $id) {
          if ($item['quantity'] > 0) {
            $item['quantity'] = $item['quantity'] - 1;
          } else {
            unset($cart, $item);
          }
        }
      }

      $request->session()->put('cart', $cart);
      return $cart;
    }

    public function searchByName(Request $request, $substring)
    {
      return Product::where('name', 'LIKE', '%'.$substring.'%')->get();

    }

    public function searchByCategory(Request $request, $categoryId)
    {
      if($categoryId < 0) {
        return Product::paginate(12);
      } else {
        return Product::where('category_id', '=', $categoryId)->paginate(12);
      }
    }
}
