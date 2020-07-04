<?php

declare(strict_types=1);

use App\RomanNumeralsConverter;
use Assert\AssertionFailedException;

it('converts numbers to roman numerals', function (int $number, string $expected): void {
    assertSame($expected, RomanNumeralsConverter::convert($number));
})->with([
    [1, 'I'],
    [2, 'II'],
    [3, 'III'],
    [4, 'IV'],
    [5, 'V'],
    [9, 'IX'],
    [10, 'X'],
    [15, 'XV'],
    [19, 'XIX'],
    [20, 'XX'],
    [21, 'XXI'],
    [40, 'XL'],
    [50, 'L'],
    [80, 'LXXX'],
    [90, 'XC'],
    [100, 'C'],
    [110, 'CX'],
    [400, 'CD'],
    [500, 'D'],
    [700, 'DCC'],
    [900, 'CM'],
    [1000, 'M'],
    [1986, 'MCMLXXXVI'],
    [1990, 'MCMXC'],
    [2020, 'MMXX'],
]);

it('cannot convert negative numbers', function (): void {
    RomanNumeralsConverter::convert(-1);
})->throws(AssertionFailedException::class, 'Cannot convert negative numbers');
