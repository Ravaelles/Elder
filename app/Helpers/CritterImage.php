<?php

namespace App\Helpers;

use App\Critter;

class CritterImage {

    public static function create($id) {
        $critterImage = new CritterImage;
        $critterImage->id = $id;
        return $critterImage;
    }

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

    public function warriorSpear() {
        $this->sex = Critter::MALE;
        $this->critter = Critter::WARRIOR_MALE;
        $this->action(Critter::SPEAR_IDLE);
        return $this;
    }

    public function warriorFemaleSpear() {
        $this->sex = Critter::FEMALE;
        $this->critter = Critter::WARRIOR_FEMALE;
        $this->action = Critter::SPEAR_IDLE;
        return $this;
    }

    // =========================================================================
    // ACTION

    public function actionRandomStatic() {
        $this->action(Critter::ACTION_RANDOM_STATIC);
        return $this;
    }

    public function actionRandomSpear() {
        $this->action(Critter::SPEAR_RANDOM);
        return $this;
    }

    public function action($action) {
        if ($action === Critter::ACTION_RANDOM_STATIC) {
            $randomStaticActions = [
//                Critter::ACTION_DODGE,
                Critter::ACTION_HAND_COMBAT,
                Critter::ACTION_IDLE,
                Critter::ACTION_PICK_UP,
                Critter::ACTION_USE,
            ];
            $action = $randomStaticActions[mt_rand(0, count($randomStaticActions) - 1)];
        } else if ($action === Critter::SPEAR_RANDOM) {
            $randomStaticActions = [
//                Critter::SPEAR_DODGE,
                Critter::SPEAR_EQUIP,
                Critter::SPEAR_IDLE,
//                Critter::SPEAR_WALK,
                Critter::SPEAR_UNEQUIP,
                Critter::SPEAR_THRUST,
                Critter::SPEAR_THROW,
            ];
            $action = $randomStaticActions[mt_rand(0, count($randomStaticActions) - 1)];
        }

        $this->action = $action;
        return $this;
    }

    // =========================================================================
    // SEX

    public function male() {
        return $this->sex(Critter::MALE);
    }

    public function female() {
        return $this->sex(Critter::FEMALE);
    }

    // =========================================================================
    // SEX

    public function sex($sex) {
        $this->sex = strtolower($sex);
        if (strlen($this->sex) == 1) {
            $this->sex = "n" . $this->sex;
        }

        if ($this->sex === Critter::FEMALE) {
            if ($this->critter == Critter::WARRIOR_MALE) {
                $this->critter = Critter::WARRIOR_FEMALE;
            }
        }

        return $this;
    }

    // =========================================================================
    // DIRECTION

    public function dir($dir) {
        $this->dir = $dir;
        return $this;
    }

    // =========================================================================

    public $id = null;
    public $sex = Critter::MALE;
    public $action = Critter::ACTION_IDLE;
    public $dir = Critter::DIR_SE;
    public $critter = null;

    public function __toString() {
        return Image::gifFor($this->id, $this->critter, $this->action, $this->dir, $this->sex);
    }

}
