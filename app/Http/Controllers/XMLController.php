<?php

namespace App\Http\Controllers;

use App\Utils\clXMLParser;
use Illuminate\Http\Request;
class XMLController extends Controller
{
    function parseXML(Request $request) {
        $parser = new clXMLParser();
        $parser::parse($request->all()['file']);
        dd($parser);
    }
}
