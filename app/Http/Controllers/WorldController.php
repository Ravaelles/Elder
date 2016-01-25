<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\UnitImage as UnitImage;

class WorldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function map() {
//        return 'data:image/gif;base64,"`curl --silent \'https://dl.dropboxusercontent.com/u/4258402/nmwarrgb_e.gif\' | base64 --wrap=0`';
//        return "curl https://dl.dropboxusercontent.com/u/4258402/nmwarrgb_e.gif | base64 --wrap=0";
        return view('engine.map');
    }

}
