<?php

declare(strict_types=1);

use function App\flattenArray;

it('flattens an array', function (
    array $input,
    array $expected
): void {
    $result = flattenArray($input);

    assertSame($expected, $result);
})->with([
    [
        'input' => [1, 2, 3],
        'expected' => [1, 2, 3],
    ],
    [
        'input' => [1, [2, 3, null, 4], [null], 5],
        'expected' => [1, 2, 3, 4, 5],
    ],
    [
        'input' => [1, [2, [[3]], [4, [[5]]], 6, 7], 8],
        'expected' => [1, 2, 3, 4, 5, 6, 7, 8],
    ],
    [
        'input' => [null, [[[null]]], null, null, [[null, null], null], null],
        'expected' => [],
    ]
]);
