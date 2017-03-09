<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller {

//    public function get($imgPath) {
//        $imgPath = str_replace("..", "", $imgPath);
//        $fullPath = public_path() . '/img/' . $imgPath;
//
//        header("Content-type: image/gif");
////        header("Pragma-directive: no-cache");
////        header("Cache-directive: no-cache");
////        header("Cache-control: no-cache");
////        header("Pragma: no-cache");
////        header("Expires: 0");
//
//        readfile($fullPath);
////        if (File::exists($fullPath)) {
////
////            $filetype = File::type($fullPath);
////
////            $response = Response::make(File::get($fullPath), 200);
////
////            $response->header('Content-Type', $filetype);
////            return $response;
////        }
//    }
}
