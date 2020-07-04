<?php

declare(strict_types=1);

use App\Bob;

it('replies with a standard response', function (): void {
    $input = 'Foo bar';
    $expected = Bob::RESPONSE_DEFAULT;

    assertSame($expected, Bob::saySomethingTo($input)->getResponse());
});

it('replies if you address him without saying anything', function (): void {
    $input = '';
    $expected = Bob::RESPONSE_SAY_NOTHING;

    assertSame($expected, Bob::saySomethingTo($input)->getResponse());
});

it('replies to a question', function (): void {
    $input = 'How are you?';
    $expected = Bob::RESPONSE_QUESTION;

    assertSame($expected, Bob::saySomethingTo($input)->getResponse());
});

it('replies to yelling', function (): void {
    $input = 'Go to bed!';
    $expected = Bob::RESPONSE_YELLING;

    assertSame($expected, Bob::saySomethingTo($input)->getResponse());
});

it('replies to yelling a question', function (): void {
    $input = 'Are you OK?!';
    $expected = Bob::RESPONSE_YELLING_QUESTION;

    assertSame($expected, Bob::saySomethingTo($input)->getResponse());
});
