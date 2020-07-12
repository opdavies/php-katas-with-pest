<?php

declare(strict_types=1);

namespace App;

function flattenArray(array $input, array &$output = []): array
{
    foreach ($input as $item) {
        if (!is_array($item)) {
            $output[] = $item;
            continue;
        }

        flattenArray($item, $output);
    }

    return array_values(array_filter($output));
}