<?php

namespace App;

class SPECIAL extends Eloquent {

    const BASE = 100;

    public $fillable = [
        'strength',
        'agility',
        'intelligence',
        'charisma',
    ];

    // =========================================================================
    // Custom functions

    public static function generateSpecialForTribesman() {
        $SPECIAL = new SPECIAL;

        $SPECIAL->randomizeSPECIALs([
            'strength' => self::BASE,
            'agility' => self::BASE,
            'intelligence' => self::BASE,
            'charisma' => self::BASE,
        ]);

        return $SPECIAL;
    }

    // =======

    private function randomizeSPECIALs(array $base) {
        foreach ($base as $specialName => $baseValue) {
            $value = $this->randomizeBaseValue($baseValue);
            $this->$specialName = $value;
        }
    }

    private static function randomizeBaseValue($value) {
        return self::BASE + self::BASE / 2 - rand(0, self::BASE);
//        return min(self::BASE + $halfBase, max(self::BASE - $halfBase, $value));
    }

    // =========================================================================
    // Accessors & Mutators

    public function getSAttribute($value) {
        $value = $this->strength;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getAAttribute($value) {
        $value = $this->agility;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getIAttribute($value) {
        $value = $this->intelligence;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getCAttribute($value) {
        $value = $this->charisma;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

}
