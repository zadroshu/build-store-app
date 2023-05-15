<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductController extends Controller
{
    protected $session ;

    function __construct() {
        $this->session  = new Session();
    }

    /**
     * Returns a listing of the resource.
     *
     * @return json
     */
    public function index()
    {
        return response()->json(Product::paginate(12));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:191',
            'category' => 'required|int',
            'cost' => 'required|int',
            'discount' => 'required|int',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|string|max:255',
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
            'image' => 'nullable|string|max:255',
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
     * Returns the specified resource.
     *
     * @param int $id
     * @return json
     */
    public function show(int $id)
    {
        return response()->json(Product::where('id', $id)->get());
    }

    /**
     * Update cart product by id.
     *
     * @param int $id
     * @return json
     */
    public function updateCart(Request $request)
    {
    //  
    }

    public function deleteProduct(int $id)
    {
    //    
    }

    /**
     * Add to cart product by id.
     *
     * @param int $id
     * @return json
     */
    public function addToCart(Request $request, int $id)
    {
        $cart = $this->session->get('cart', []);
        $product = Product::find($id);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "id" => $product->id,
                "name" => $product->name,
                "quantity" => 1,
                "cost" => $product->cost,
            ];
        }
        $this->session->set('cart', $cart);
        return response()->json($cart);
    }

    /**
     * Returns cart.
     *
     * @return json
     */
    public function getCart(Request $request)
    {
        $cart = $this->session->get('cart', []);
        return response()->json($cart);
    }

    public function deleteFromCart(Request $request, $id)
    {
        // 
    }

    /**
     * Returns a listing of the resource by name.
     *
     * @param int $substring
     * @return json
     */
    public function searchByName($substring)
    {
        return response()->json(Product::where('name', 'LIKE', '%'.$substring.'%')->get());

    }

    /**
     * Returns a listing of the resource by category.
     *
     * @param int $categoryId
     * @return json
     */
    public function searchByCategory($categoryId)
    {
        return response()->json(Product::where('category_id', $categoryId)->paginate(12));
        
    }

    /**
     * Returns a listing of the resource by category and cost.
     *
     * @param int $categoryId
     * @param int $sortId
     * @return json
     */

    public function sort(int $categoryId, int $sortId)
    {   

        // dump($isCategory);
        $products = DB::table('products')
            ->when($categoryId, function(Builder $query, int $categoryId) {
                // dump($categoryId);
                if ($categoryId != -1) {
                    return $query->where('category_id', $categoryId);;
                }
            })
            ->when($sortId == 0, function(Builder $query, int $sortId) {
              
                $query->orderBy('cost', 'desc');
            })
            ->when($sortId == 1, function(Builder $query, int $sortId) {
                
                $query->orderBy('cost', 'asc');
            })
            ->paginate(12);
            
        return response()->json($products);
    }
}
