<?php

declare(strict_types=1);

namespace App;

use Tightenco\Collect\Support\Collection;

final class Anagram
{
    private static function sortLettersInWord(string $word): string
    {
        return (new Collection(str_split($word)))
            ->sort()
            ->implode('');
    }

    public static function forWord(string $word, array $candidates): Collection
    {
        $word = static::sortLettersInWord($word);

        return (new Collection($candidates))
            ->filter(fn (string $candidate): bool =>
                static::sortLettersInWord($candidate) == $word)
            ->values();
    }
}
