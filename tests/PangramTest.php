<?php

use function App\isPangram;

it('determines if a string is a pangram', function (
    string $input,
    bool $expected
) {
    assertSame($expected, isPangram($input));
})->with([
    [
        'input' => 'hello word',
        'expected' => false,
    ],
    [
        'input' => 'The quick brown fox jumps over the lazy dog',
        'expected' => true,
    ]
]);