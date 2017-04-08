<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait PersonJob
{

    public function getJobToString()
    {
        return empty($person->job) ? "In village" : $person->job;
    }

}
