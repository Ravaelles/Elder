<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\WorldGenerator;

class WorldController extends Controller {

    public function index($show = null) {
//        $cities = Band::all();
        $world = WorldGenerator::generateWorld();
        $worldJson = $world->createJson();
//        dd($world->tiles);
//        dd($worldJson);

        return view('world.world')->with(compact('world', 'worldJson'));
    }

}
