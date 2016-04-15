<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UnitImage as UnitImage;
use App\City;
use App\Location;

class WorldmapController extends Controller {

    public function index() {
        $cities = City::all();
//        $locations = Location::all();
//        return view('worldmap.map')->with(compact('locations'));
        return view('worldmap.map')->with(compact('cities'));
    }

}
