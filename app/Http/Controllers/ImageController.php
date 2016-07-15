<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ImageController extends Controller {

    public function test() {
        $imagePath = "img/world/people/person-right.gif";

        $this->brightnessContrastImage($imagePath, 80, 120, 1);

//        $this->displayImage($imagePath);
    }

    // =========================================================================

    private function displayImage($imagePath) {
        echo "<img src='$imagePath' /><br /><br />";
    }

    // =========================================================================

    function brightnessContrastImage($imagePath, $brightness, $contrast, $channel) {
        $imagick = new \Imagick(realpath($imagePath));
        $imagick->brightnessContrastImage($brightness, $contrast, $channel);
        header("Content-Type: image/gif");
//        echo $imagick->getImageBlob();
//        $imagick->writeImage("/img/world/people/php.gif");
//        $im->setImageFormat ("jpeg");
        file_put_contents(public_path("/img/world/people/php.gif"), $imagick);
    }

    public function lol() {
        $GIF = new Imagick();
        $GIF->setFormat("gif");

        for ($i = 0; $i < sizeof($_FILES); ++$i) {
            $frame = new Imagick();
            $frame->readImage($_FILES["image$i"]["tmp_name"]);
            $frame->setImageDelay(10);
            $GIF->addImage($frame);
        }

        header("Content-Type: image/gif");
        echo $GIF->getImagesBlob();
    }

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
