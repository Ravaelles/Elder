<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller {

    public function dataUri($file) {
        $basePath = base_path() . "/public/img/critter/all/";
        $file = $basePath . "nmwarrgb_e.gif";
        return "data:image/gif;base64," . base64_encode(file_get_contents($file) . rand(0, 99));
    }

}
