<?php

namespace App;

trait Stats
{

    static $BASE_VALUE = 100;
//    public $fillable = [
//        'strength',
//        'agility',
//        'intelligence',
//        'charisma',
//    ];
    // =========================================================================
    // Custom functions

    public function generateStatsForTribesman()
    {
        $stats = $this->randomizeStats([
            's' => self::$BASE_VALUE,
            'a' => self::$BASE_VALUE,
            'i' => self::$BASE_VALUE,
            'c' => self::$BASE_VALUE,
        ]);

        return $stats;
    }

    // =========================================================================

    private function randomizeStats(array $base)
    {
        $stats = [];

        foreach ($base as $specialName => $baseValue) {
            $value = $this->randomizeBaseValue($baseValue);
            $stats[$specialName] = $value;
        }

        return $stats;
    }

    private static function randomizeBaseValue($value) {
        return self::$BASE_VALUE + self::$BASE_VALUE / 2 - rand(0, self::$BASE_VALUE);
//        return min(self::$BASE_VALUE + $halfBase, max(self::$BASE_VALUE - $halfBase, $value));
    }

    // =========================================================================
    // Accessors & Mutators

    public function setStats($stats)
    {
        $this->stats = $stats;
    }

    public function getStats()
    {
        return $this->stats;
    }

    private function getStat($field)
    {
        return $this->stats[$field];
    }

    public function getS()
    {
        $value = $this->getStat('s');
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getA()
    {
        $value = $this->getStat('a');
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getI()
    {
        $value = $this->getStat('i');
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

    public function getC()
    {
        $value = $this->getStat('c');
        return \App\Helpers\String::coloredValue($value, 1, 10);
    }

}
