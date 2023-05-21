<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use Illuminate\Http\Request;

/**
* Returns a listing of the resource.
*
* @return json
*/
class CategoryController extends Controller
{
    /**
     * Returns a paginated listing of the resource.
     *
     * @return json
     */

    public function getCategories() 
    {
        return response()->json(Category::paginate());
    }

    /**
     * Returns a listing of the resource.
     *
     * @return json
     */

    public function getAllCategories() 
    {
        return response()->json(Category::all());
    }

    /**
     * Returns the specified resource.
     *
     * @param int $id
     * @return json
     */
    public function show(int $id)
    {
        return response()->json(Category::where('id', $id)->get());
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
        ]);

        $response = Category::where('id', $validated['id'])->update($validated);

        return response()->json($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:191',
        ]);
        $category = new Category($validated);
        $response = $category->save();

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
      return response()->json(Category::find($id)->delete());
    }
}
