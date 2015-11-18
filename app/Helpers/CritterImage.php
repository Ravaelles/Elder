<?php

namespace App\Helpers;

use App\Critter;

class CritterImage {
    
    // =========================================================================
    // CRITTER

    public function warrior() {
        $this->sex = Critter::MALE;
        $this->critter = Critter::WARRIOR_MALE;
        return $this;
    }

    public function warriorFemale() {
        $this->sex = Critter::FEMALE;
        $this->critter = Critter::WARRIOR_FEMALE;
        return $this;
    }

    // =========================================================================
    // ACTION

    public function actionRandomStatic() {
        $this->action = Critter::ACTION_RANDOM_STATIC;
        return $this;
    }

    // =========================================================================
    // SEX

    public function male() {
        $this->sex = Critter::MALE;
        return $this;
    }

    public function female() {
        $this->sex = Critter::FEMALE;
        return $this;
    }

    // =========================================================================
    // DIRECTION

    public function dir($dir) {
        $this->direction = $dir;
        return $this;
    }

    // =========================================================================

    protected $sex = Critter::MALE;
    protected $action = Critter::ACTION_IDLE;
    protected $direction = Critter::DIR_SE;
    protected $critter = null;

    public function __toString() {
        return Image::gifFor($this->critter, $this->action, $this->direction, $this->sex);
    }

}
