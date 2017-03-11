<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EngineController extends Controller
{

    public function engine($show = null)
    {
        return view('engine.engine');
    }

}
