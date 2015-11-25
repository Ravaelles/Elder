<?php

namespace App;

use App\Helpers\UnitImage as UnitImage;
use App\Unit as Unit;
use App\SPECIAL;
//use Illuminate\Database\Eloquent\Model;

class Person extends Eloquent {

//    protected $sortable = [
//        'strength'
//    ];
    // =========================================================================
    // Generator

    public static function generateAndSave() {
        $special = SPECIAL::generateSpecialForTribesman();

        $person = new Person;
        $person->user = \Auth::user()->id;
        $person->sex = rand(0, 64) <= 31 ? "M" : "F";
        $person->name = Helpers\Names::randomName($person->sex);
        $person->save();
        $person->SPECIAL()->save($special);

        return $person;
    }

    // =========================================================================
    // Custom functions

    public function unitJson() {

        // SEX
        $sex = $this->sex ? $this->sex : "M";

        // UNIT TYPE
        $type = $sex === "F" ? Unit::WARRIOR_FEMALE : Unit::WARRIOR_MALE;

        // =========================================================================

        $json = json_encode([
            "id" => $this->id,
            "sex" => $sex,
            "action" => null,
            "dir" => null,
            "type" => $type,
        ]);
        return $json;

//        $unitImage = $this->getUnitImageParams();
//
//        $unitImage->action = Unit::SPEAR_EQUIP;
//
//        $json = json_encode([
//            "id" => $unitImage->id,
//            "sex" => $unitImage->sex,
//            "action" => $unitImage->action,
//            "dir" => $unitImage->dir,
//            "type" => $unitImage->type,
//        ]);
//        return $json;
    }

//    public function getUnitImageParams() {
//        return UnitImage::create($this->id)->warriorSpear()->sex($this->sex);
//    }
    // =========================================================================

    public function descriptionAmong($persons) {
        $bestTraits = [];
        $goodTraits = [];

        $higherS = 0;
        $higherP = 0;
        $higherE = 0;
        $higherC = 0;
        $higherI = 0;
        $higherA = 0;
        $higherL = 0;
        foreach ($persons as $otherPerson) {
            $higherS += ($this->S < $otherPerson->S);
            $higherP += ($this->P < $otherPerson->P);
            $higherE += ($this->E < $otherPerson->E);
            $higherC += ($this->C < $otherPerson->C);
            $higherI += ($this->I < $otherPerson->I);
            $higherA += ($this->A < $otherPerson->A);
            $higherL += ($this->L < $otherPerson->L);
        }

        // =========================================================================

        $numOfPeople = count($persons);
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherS, $numOfPeople, "strongest", "strong");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherP, $numOfPeople, "most observant", "observant");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherE, $numOfPeople, "toughest", "tough");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherC, $numOfPeople, "best leader", "leader");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherI, $numOfPeople, "wisest", "wise");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherA, $numOfPeople, "fittest", "agile");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherL, $numOfPeople, "luckiest bastard", "lucky");

        // =========================================================================

        if (count($bestTraits) || count($goodTraits)) {
            if (count($bestTraits) + count($goodTraits) > 3) {
                $goodTraits = [];
            }
            return implode(", ", $bestTraits) . (count($goodTraits) && count($bestTraits) ? ", " : "")
                . implode(", ", $goodTraits);
        } else {
            return "Balanced personality";
        }
    }

    private function createTraitIfPossible(&$bestTraits, &$goodTraits, $numOfBetterPeople, $numOfPeople, $stringIfBest, $stringIfGood) {
        if ($numOfBetterPeople == 0) {
            $bestTraits[] = "<span class='person-trait-best'>$stringIfBest</span>";
        } else if ($numOfBetterPeople <= $numOfPeople / 4) {
            $goodTraits[] = "<span class='person-trait-good'>$stringIfGood</span>";
        }
    }

    public function unitImageWrapper() {
        return "<div class='static-unit-image-wrapper' id='unit-wrapper-" . $this->id . "'></div>";
    }

    // =========================================================================
    // Scopes

    public function scopeOur($query) {
        return $query->where('user', \Auth::user()->id);
    }

    // =========================================================================
    // Accessors & Mutators

    public function getImageAttribute($value) {
//        return Image::create()->warrior()->action(Unit::SPEAR_IDLE);
        return $this->getUnitImageParams()->action(Unit::SPEAR_EQUIP);
//        return Image::gifFor(
//                Unit::WARRIOR, Unit::ACTION_RANDOM_STATIC, Unit::DIR_SE
//        );
    }

    public function getJobAttribute($value) {
        if (empty($value)) {
            return "";
        }
        return $value;
    }

    public function getSAttribute($value) {
        return $this->SPECIAL->strength;
    }

    public function getPAttribute($value) {
        return $this->SPECIAL->perception;
    }

    public function getEAttribute($value) {
        return $this->SPECIAL->endurance;
    }

    public function getCAttribute($value) {
        return $this->SPECIAL->charisma;
    }

    public function getIAttribute($value) {
        return $this->SPECIAL->intelligence;
    }

    public function getAAttribute($value) {
        return $this->SPECIAL->agility;
    }

    public function getLAttribute($value) {
        return $this->SPECIAL->luck;
    }

    // =========================================================================
    // Relations

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

    public function SPECIAL() {
        return $this->embedsOne(\App\SPECIAL::class);
//        return $this->hasOne(\App\SPECIAL::class);
    }

}
