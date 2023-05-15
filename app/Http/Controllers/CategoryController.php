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
/**
     * Returns a listing of the resource.
     *
     * @return json
     */
{
    public function getCategories() 
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
}
