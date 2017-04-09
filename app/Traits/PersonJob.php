<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait PersonJob
{

    public function getJobToString()
    {
        return empty($person->job) ? "In village" : $person->job;
    }

    public function getJobAttribute($value)
    {
        if (empty($value)) {
            return "";
        }
        return $value;
    }

    public function setJob($job)
    {
        $this->job = $job;
    }

}
