<?php

namespace App;

use App\Helpers\CritterImage as CritterImage;
use App\Critter as Critter;
use App\SPECIAL;
use Illuminate\Database\Eloquent\Model;

class Person extends Eloquent {

    protected $sortable = [
        'strength'
    ];

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
        $critterImage = $this->critterImage();

        $critterImage->action = Critter::SPEAR_EQUIP;

        $json = json_encode([
            "id" => $critterImage->id,
            "sex" => $critterImage->sex,
            "action" => $critterImage->action,
            "dir" => $critterImage->dir,
            "critter" => $critterImage->critter,
        ]);
        return $json;
    }

    public function critterImage() {
        return CritterImage::create($this->id)->warriorSpear()->sex($this->sex);
    }

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

    public function critterImageId() {
        return "unit-id-" . $this->id;
    }

    public function critterImageWrapper() {
        return "<div class='critter-image-wrapper' id='" . $this->critterImageId() . "'></div>";
    }

    // =========================================================================
    // Scopes

    public function scopeOur($query) {
        return $query->where('user', \Auth::user()->id);
    }

    // =========================================================================
    // Accessors & Mutators

    public function getImageAttribute($value) {
//        return Image::create()->warrior()->action(Critter::SPEAR_IDLE);
        return $this->critterImage()->action(Critter::SPEAR_EQUIP);
//        return Image::gifFor(
//                Critter::WARRIOR, Critter::ACTION_RANDOM_STATIC, Critter::DIR_SE
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
