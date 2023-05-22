<?php

namespace App\Http\Controllers;

use App\Models\clXMLParser;
use Illuminate\Http\Request;
class XMLController extends Controller
{
    function parseXML(Request $request) {
        // $parser = new clXMLParser();
        // $parser::parse($request->all()['file']);
        // dd($parser);
        $file = $request->all()['file'];
        $fileSize = $file->getSize();
        $fileName = $file->getClientOriginalName();
    
        $stream = fopen($fileName, 'r');
        $parser = xml_parser_create();
        // set up the handlers here
        while (($data = fread($stream, $fileSize))) {
            $parsed = xml_parse($parser, $data); // parse the current chunk
        }
        xml_parse($parser, '', true); // finalize parsing
        xml_parser_free($parser);
        fclose($stream);
        dd($parsed);
    }
}
