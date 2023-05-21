<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Models\Product;
use Symfony\Component\HttpFoundation\Session\Session;

class ProductController extends Controller
{
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
     * @return json
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name' => 'required|string|max:191',
            'category_id' => 'required|int',
            'cost' => 'required|int',
            'discount' => 'required|int',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|string|max:255',
            'in_stock' => 'required|int',
        ]);
        $validated['image'] = $validated['image'] ?? '../../../publik';
        $product = new Product($validated);
        $response = $product->save();

        return response()->json($response);
    }

    /**
     * Save the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return json
     */
    public function update(Request $request)
    {
        $validated = $request->validate([
            'id' => 'required|int',
            'name' => 'required|string|max:191',
            'category_id' => 'required|int',
            'cost' => 'required|int',
            'discount' => 'required|int',
            'description' => 'required|string|max:1000',
            'image' => 'nullable|string|max:255',
            'in_stock' => 'required|int',
        ]);

        $response = Product::where('id', $validated['id'])->update($validated);

        return response()->json($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return json
     */
    public function delete(int $id)
    {
      return response()->json(Product::find($id)->delete());
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
        $products = DB::table('products')
            ->when($categoryId, function(Builder $query, int $categoryId) {
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
