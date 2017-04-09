<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Job;
use App\Person;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PersonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
//    public function index()
//    {
////        \App\Helpers\Helper::timeStart();
//        $persons = Person::truncate();
//        $persons = Person::our()->get();
//
//        if ($persons->isEmpty()) {
//            for ($i = 0; $i < 4; $i++) {
//                Person::generateAndSave();
//            }
//            $persons = Person::our()->get();
//        }
//
////        \App\Helpers\Helper::timeEnd();
////        exit;
//        return view('person.index')->with(compact('persons'));
//    }
    
    // === Jobs ===========================================================

    public function assignJobIdle($id)
    {
        $this->assignJob($id, Job::IDLE);
    }

    public function assignJobCraft($id)
    {
        $this->assignJob($id, Job::CRAFT);
    }

    public function assignJobExplore($id)
    {
        $this->assignJob($id, Job::EXPLORE);
    }

    private function assignJob($id, $job)
    {
        $person = Person::findOrFail($id);
        $person->setJob($job);
        $person->save();

        $this->jsonResponse($person->getJobToString());
    }

}
