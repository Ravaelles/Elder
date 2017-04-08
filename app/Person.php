<?php

namespace App;

use App\Helpers\UnitImage as UnitImage;
use App\Unit as Unit;
use App\Stats;

//use Illuminate\Database\Eloquent\Model;

class Person extends Eloquent
{

    use Stats;

//    protected $sortable = [
//        'strength'
//    ];
    // =========================================================================
    // Generator

    public static function generateAndSave()
    {
        $userId = \Auth::user();
        $userId = $userId != null ? $userId->id : null;

        $person = new Person;
        $person->user = $userId;
        $person->sex = rand(0, 64) <= 31 ? "M" : "F";
        $person->name = Helpers\Names::randomName($person->sex);
        $person->setStats($person->generateStatsForTribesman());
        $person->save();

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
        $higherA = 0;
        $higherI = 0;
        $higherC = 0;
        foreach ($persons as $otherPerson) {
            $higherS += ($this->getS() < $otherPerson->getS());
            $higherA += ($this->getA() < $otherPerson->getA());
            $higherI += ($this->getI() < $otherPerson->getI());
            $higherC += ($this->getC() < $otherPerson->getC());
        }

        // =========================================================================

        $numOfPeople = count($persons);
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherS, $numOfPeople, "strongest", "strong");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherI, $numOfPeople, "wisest", "wise");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherA, $numOfPeople, "fittest", "agile");
        $this->createTraitIfPossible($bestTraits, $goodTraits, $higherC, $numOfPeople, "best leader", "leader");

        // =========================================================================

        if (count($bestTraits) || count($goodTraits)) {
            if (count($bestTraits) + count($goodTraits) > 3) {
                $goodTraits = [];
            }
            $comma = "<span class='gray'>,</span> ";
            return implode($comma, $bestTraits) . (count($goodTraits) && count($bestTraits) ? $comma : "")
                . implode($comma, $goodTraits);
        } else {
            return "Balanced";
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

    public function scopeOur($query)
    {
        $userId = \Auth::user();
        $userId = $userId != null ? $userId->id : null;

        return $query->where('user', $userId);
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

    // =========================================================================
    // Relations

    public function user() {
        return $this->belongsTo(\App\User::class);
    }

}
