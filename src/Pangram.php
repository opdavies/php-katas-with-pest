<?php

declare(strict_types=1);

namespace App;

function isPangram(string $input): bool
{
    $split = str_split($input);
    $lower = array_map('strtolower', $split);
    $filtered = array_filter($lower, fn(string $letter) => $letter != ' ');

    return count(array_unique($filtered)) == 26;
}
