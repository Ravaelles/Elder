<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UnitImage as UnitImage;

class WorldmapController extends Controller {

    public function index() {
        $locations = Location::all();
        return view('worldmap.map')->with(compact('locations'));
    }

}
