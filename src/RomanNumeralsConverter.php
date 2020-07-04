<?php

declare(strict_types=1);

namespace App;

use Assert\Assert;

final class RomanNumeralsConverter
{
    private static $map = [
        1000 => 'M',
        900 => 'CM',
        500 => 'D',
        400 => 'CD',
        100 => 'C',
        90 => 'XC',
        50 => 'L',
        40 => 'XL',
        10 => 'X',
        9 => 'IX',
        5 => 'V',
        4 => 'IV',
        3 => 'III',
        2 => 'II',
        1 => 'I',
    ];

    public static function convert(int $input): string
    {
        Assert::that($input)
            ->greaterOrEqualThan(0, 'Cannot convert negative numbers');

        $letters = '';

        while ($input > 0) {
            foreach (static::$map as $number => $letter) {
                if ($input >= $number) {
                    // Add the appropriate numeral and reduce the value of
                    // $input accordingly.
                    $letters .= $letter;
                    $input = ($input - $number);
                    break;
                }
            }
        }

        return $letters;
    }
}
