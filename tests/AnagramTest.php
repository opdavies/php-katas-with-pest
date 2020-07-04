<?php

declare(strict_types=1);

use App\Anagram;

it('selects the correct anagrams for a word', function () {
    $matches = Anagram::forWord(
        'listen',
        ['enlists', 'google', 'inlets', 'banana']
    );

    assertSame(['inlets'], $matches->toArray());
});
