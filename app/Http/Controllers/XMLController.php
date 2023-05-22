<?php

namespace App\Http\Controllers;

use App\Models\XMLParser;
use Illuminate\Http\Request;
class XMLController extends Controller
{
    function parseXML(Request $request) {
        $XMLParser = new XMLParser();
        $XMLParser->init();
        $xml = file_get_contents($request->all()['file']->getRealPath());
        var_dump($XMLParser->parse($xml));exit;
        
        dd($xml);
    }
}
