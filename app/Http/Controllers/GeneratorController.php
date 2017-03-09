<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Generator;

class GeneratorController extends Controller {

    public function generateWorld() {
        Generator::generateWorld();
    }

}
