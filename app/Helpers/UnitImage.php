<?php

//namespace App\Helpers;
//
//use App\Unit;
//
//class UnitImage {
//
//    public static function create($id) {
//        $unitImage = new UnitImage;
//        $unitImage->id = $id;
//        return $unitImage;
//    }
//
//    // =========================================================================
//    // TYPE
//
//    public function warrior() {
//        $this->sex = Unit::MALE;
//        $this->type = Unit::WARRIOR_MALE;
//        return $this;
//    }
//
//    public function warriorFemale() {
//        $this->sex = Unit::FEMALE;
//        $this->type = Unit::WARRIOR_FEMALE;
//        return $this;
//    }
//
//    public function warriorSpear() {
//        $this->sex = Unit::MALE;
//        $this->type = Unit::WARRIOR_MALE;
//        $this->action(Unit::SPEAR_IDLE);
//        return $this;
//    }
//
//    public function warriorFemaleSpear() {
//        $this->sex = Unit::FEMALE;
//        $this->type = Unit::WARRIOR_FEMALE;
//        $this->action = Unit::SPEAR_IDLE;
//        return $this;
//    }
//
//    // =========================================================================
//    // ACTION
//
//    public function actionRandomStatic() {
//        $this->action(Unit::ACTION_RANDOM_STATIC);
//        return $this;
//    }
//
//    public function actionRandomSpear() {
//        $this->action(Unit::SPEAR_RANDOM);
//        return $this;
//    }
//
//    public function action($action) {
//        if ($action === Unit::ACTION_RANDOM_STATIC) {
//            $randomStaticActions = [
////                Unit::ACTION_DODGE,
//                Unit::ACTION_HAND_COMBAT,
//                Unit::ACTION_IDLE,
//                Unit::ACTION_PICK_UP,
//                Unit::ACTION_USE,
//            ];
//            $action = $randomStaticActions[mt_rand(0, count($randomStaticActions) - 1)];
//        } else if ($action === Unit::SPEAR_RANDOM) {
//            $randomStaticActions = [
////                Unit::SPEAR_DODGE,
//                Unit::SPEAR_EQUIP,
//                Unit::SPEAR_IDLE,
////                Unit::SPEAR_WALK,
//                Unit::SPEAR_UNEQUIP,
//                Unit::SPEAR_THRUST,
//                Unit::SPEAR_THROW,
//            ];
//            $action = $randomStaticActions[mt_rand(0, count($randomStaticActions) - 1)];
//        }
//
//        $this->action = $action;
//        return $this;
//    }
//
//    // =========================================================================
//    // SEX
//
//    public function male() {
//        return $this->sex(Unit::MALE);
//    }
//
//    public function female() {
//        return $this->sex(Unit::FEMALE);
//    }
//
//    // =========================================================================
//    // SEX
//
//    public function sex($sex) {
//        $this->sex = strtolower($sex);
//        if (strlen($this->sex) == 1) {
//            $this->sex = "n" . $this->sex;
//        }
//
//        if ($this->sex === Unit::FEMALE) {
//            if ($this->type == Unit::WARRIOR_MALE) {
//                $this->type = Unit::WARRIOR_FEMALE;
//            }
//        }
//
//        return $this;
//    }
//
//    // =========================================================================
//    // DIRECTION
//
//    public function dir($dir) {
//        $this->dir = $dir;
//        return $this;
//    }
//
//    // =========================================================================
//
//    public $id = null;
//    public $sex = Unit::MALE;
//    public $action = Unit::ACTION_IDLE;
//    public $dir = Unit::DIR_SE;
//    public $type = null;
//
//    public function __toString() {
//        return Image::gifFor($this->id, $this->type, $this->action, $this->dir, $this->sex);
//    }
//
//}
