<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WorldGenerator;

class MapController extends Controller {

    public function index($show = null) {
//        $cities = Band::all();
        $world = WorldGenerator::generateWorld();
        $worldJson = $world->createJson();
//        dd($world->tiles);
//        dd($worldJson);
//        var_dump($worldJson);
//        echo $worldJson;
//        exit;

//        ddd(json_decode($worldJson, TRUE)['map-objects']);
//        exit;

        return view('map.map')->with(compact('world', 'worldJson'));
    }

}
