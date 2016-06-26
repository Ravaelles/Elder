<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FLocationController extends Controller {

    public function index($show = null) {
        return view('location.view');
    }

}
