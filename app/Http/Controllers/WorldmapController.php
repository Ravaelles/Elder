<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UnitImage as UnitImage;
use App\Band;
use App\Location;

class WorldmapController extends Controller
{

    public function show()
    {
        $cities = Band::all();
//        $locations = Location::all();
//        return view('worldmap.map')->with(compact('locations'));
        return view('worldmap.worldmap')->with(compact('cities'));
    }

}
