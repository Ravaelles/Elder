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

}
