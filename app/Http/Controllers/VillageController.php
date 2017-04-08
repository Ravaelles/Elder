<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Person;

class VillageController extends Controller {

    public function index()
    {
//        $persons = Person::truncate();
        $persons = Person::our()->get();

        if ($persons->isEmpty()) {
            for ($i = 0; $i < 4; $i++) {
                Person::generateAndSave();
            }
            $persons = Person::our()->get();
        }

        return view('village.overview')->with(compact('persons'));
    }

}
