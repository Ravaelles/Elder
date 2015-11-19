<?php

namespace App;

class SPECIAL extends Eloquent {

    public $fillable = [
        'strength',
        'perception',
        'endurance',
        'charisma',
        'intelligence',
        'agility',
        'luck',
        'dupa'
    ];

    // =========================================================================
    // Custom functions

    public static function generateSpecialForTribesman() {
        $SPECIAL = new SPECIAL;

        $SPECIAL->randomizeSPECIALs([
            'strength' => 6,
            'perception' => 6,
            'endurance' => 7,
            'charisma' => 2,
            'intelligence' => 3,
            'agility' => 7,
            'luck' => 5,
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
        return min(10, max(1, $value + 2 - rand(0, 4)));
    }

    // =========================================================================
    // Accessors & Mutators

    public function getSAttribute($value) {
        $value = $this->strength;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getPAttribute($value) {
        $value = $this->perception;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getEAttribute($value) {
        $value = $this->endurance;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getCAttribute($value) {
        $value = $this->charisma;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getIAttribute($value) {
        $value = $this->intelligence;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getAAttribute($value) {
        $value = $this->agility;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getLAttribute($value) {
        $value = $this->luck;
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

}
