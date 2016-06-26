<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\GifFrameExtractor;

class UtilController extends Controller {
    public function gif($path) {
        $gifFilePath = public_path('img/') . $path;

        if (GifFrameExtractor::isAnimatedGif($gifFilePath)) { // check this is an animated GIF
            $gfe = new GifFrameExtractor();
            $gfe->extract($gifFilePath);

            $totalDuration = $gfe->getTotalDuration(); // Total duration of the animated GIF
            $frameNumber = $gfe->getFrameNumber(); // Number of extracted frames
            var_dump("totalDuration = $totalDuration");
            var_dump("frameNumber = $frameNumber");
            exit;
        } else {
            print_r("NOT A GIF: $gifFilePath");
            exit;
        }
    }

}
