<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Person;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        \App\Helpers\Helper::timeStart();
        $persons = Person::truncate();
        $persons = Person::our()->get();

        if ($persons->isEmpty()) {
            for ($i = 0; $i < 4; $i++) {
                Person::generateAndSave();
            }
            $persons = Person::our()->get();
        }

//        \App\Helpers\Helper::timeEnd();
//        exit;
        return view('person.index')->with(compact('persons'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
