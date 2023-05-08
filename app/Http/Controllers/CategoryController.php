<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

/**
* Returns a listing of the resource.
*
* @return json
*/
class CategoryController extends Controller
{
    public function getCategories() 
    {
        return response()->json(Category::all());
    }
}
