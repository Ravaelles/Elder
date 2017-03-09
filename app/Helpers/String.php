<?php

namespace App\Helpers;

class String {

    /**
     * Returns string with text $value with the color from red (min), through yellow, to green (max).
     * @param int $value
     * @param int $min
     * @param int $max
     */
    public static function coloredValue($value, $min, $max) {
//        $gradients = ["D10007", "DA3005", "E36004", "EC9102", "F5C101", "FFF200", "C2E600", "86DA00", "49CE00", "0DC200"];
        $gradients = ["D10007", "DA2805", "E35004", "EC7802", "F5A001", "FFC800", "C2C600", "86C500", "49C300", "0DC200"];

        $max -= $min;
        $min -= $min;
        $index = round((double) count($gradients) * $value / $max);

        if ($index < 0) {
            $index = 0;
        } else if ($index > count($gradients) - 1) {
            $index = count($gradients) - 1;
        }

        return "<span class='special-stat special-stat-colored' style='color: #"
            . $gradients[$index] . ";'>$value</span>";
    }

}
