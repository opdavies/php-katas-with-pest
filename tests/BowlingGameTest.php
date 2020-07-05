<?php

declare(strict_types=1);

use App\BowlingGame;
use Assert\Assert;
use Assert\AssertionFailedException;

beforeEach(function (): void {
   $this->game = new BowlingGame();
});

it('counts an empty game', function (): void {
    foreach (range(1, 20) as $roll) {
        $this->game->roll(0);
    }

    assertSame(0, $this->game->getScore());
});

it('counts all single pins', function (): void {
    foreach (range(1, 20) as $roll) {
        $this->game->roll(1);
    }

    assertSame(20, $this->game->getScore());
});

it('adds a roll one bonus for a spare', function (): void {
    $this->game->roll(5);
    $this->game->roll(5); // Spare

    $this->game->roll(2);

    foreach (range(1, 17) as $roll) {
        $this->game->roll(0);
    }

    assertSame(14, $this->game->getScore());
});

it('adds a two roll bonus for a strike', function (): void {
   $this->game->roll(10); // Strike

   $this->game->roll(3);
   $this->game->roll(6);

   foreach (range(1, 16) as $roll) {
       $this->game->roll(0);
   }

   assertSame(28, $this->game->getScore());
});

it('adds an extra ball for a spare on the final frame', function (): void {
   foreach (range(1, 18) as $roll) {
       $this->game->roll(0);
   }

   $this->game->roll(7);
   $this->game->roll(3); // Spare

   $this->game->roll(5);

   assertSame(15, $this->game->getScore());
});

it('adds an two extra balls for a strike on the final frame', function (): void {
   foreach (range(1, 18) as $roll) {
       $this->game->roll(0);
   }

   $this->game->roll(10); // Strike

   $this->game->roll(4);
   $this->game->roll(2);

   assertSame(16, $this->game->getScore());
});

it('scores a perfect game', function (): void {
    foreach (range(1, 12) as $roll) {
        $this->game->roll(10);
    }

    assertSame(300, $this->game->getScore());
});

it('scores a normal game', function (): void {
    $this->game->roll(4);
    $this->game->roll(3);

    $this->game->roll(10);

    $this->game->roll(4);
    $this->game->roll(1);

    $this->game->roll(0);
    $this->game->roll(2);

    $this->game->roll(3);
    $this->game->roll(7);

    $this->game->roll(8);
    $this->game->roll(1);

    $this->game->roll(10);

    $this->game->roll(0);
    $this->game->roll(7);

    $this->game->roll(1);
    $this->game->roll(5);

    $this->game->roll(10);
    $this->game->roll(6);
    $this->game->roll(1);

    assertSame(103, $this->game->getScore());
});

it('cannot knock down a negative pins', function (): void {
    $this->game->roll(-1);
})->throws(
    AssertionFailedException::class,
    'You cannot knock down a negative number of pins. Knocked down -1.'
);

it('cannot knock down more than 10 pins in a roll', function (): void {
    $this->game->roll(12);
})->throws(
    AssertionFailedException::class,
    'You can only knock down a maximum of 10 pins in a roll. Knocked down 12.'
);
