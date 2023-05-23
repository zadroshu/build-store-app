<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\XMLParser;
use Illuminate\Http\Request;
class XMLController extends Controller
{
    function parseXML(Request $request) {
        $XMLParser = new XMLParser();
        $XMLParser->init();
        $xml = file_get_contents($request->all()['file']->getRealPath());
        $result = $XMLParser->parse($xml);
        
        foreach ($result['root']['row'] as $product) {
            $productToUpdate = Product::firstOrNew(['id' => $product['id']]);

            $category = Category::firstOrNew(['id' => $product['category_id']]);

            if (!$category->exists) {
                $category = new Category();
                $category->id = $product['category_id'];
                $category->name = 'newCategory for '.$product['name'];
                $category->save();
            }

            foreach ($product as $key => $value){
                $productToUpdate->$key = $value;
            }

            $productToUpdate->save();
        };exit;
        
    }
}
