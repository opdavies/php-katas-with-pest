<?php

use Assert\AssertionFailedException;

beforeEach(function () {
    $this->game = new App\RockPaperScissorsGame();
});

it('throws an exception for an empty first move', function () {
    $this->game->firstMove('');
})->throws(AssertionFailedException::class, 'You must specify a move.');

it('throws an exception for an empty second move', function () {
    $this->game->secondMove('');
})->throws(AssertionFailedException::class, 'You must specify a move.');

it('throws an exception if an invalid first move is entered', function () {
    $this->game->firstMove('banana');
})->throws(AssertionFailedException::class, 'You must enter a valid move. banana given.');

it('throws an exception if an invalid second move is entered', function () {
    $this->game->secondMove('apple');
})->throws(AssertionFailedException::class, 'You must enter a valid move. apple given.');

it('returns the result of two different valid moves', function (
    string $firstMove,
    string $secondMove,
    string $winner
) {
    $this->game
        ->firstMove($firstMove)
        ->secondMove($secondMove);

    assertSame($winner, $this->game->getWinner());
})->with([
    [
        'firstMove' => 'rock',
        'secondMove' => 'paper',
        'winner' => 'paper',
    ],
    [
        'firstMove' => 'paper',
        'secondMove' => 'rock',
        'winner' => 'paper',
    ],
    [
        'firstMove' => 'rock',
        'secondMove' => 'scissors',
        'winner' => 'scissors',
    ],
    [
        'firstMove' => 'scissors',
        'secondMove' => 'rock',
        'winner' => 'scissors',
    ],
    [
        'firstMove' => 'scissors',
        'secondMove' => 'paper',
        'winner' => 'scissors',
    ],
    [
        'firstMove' => 'paper',
        'secondMove' => 'scissors',
        'winner' => 'scissors',
    ],
]);

test('it returns null if there is a tie', function (string $move) {
   $this->game->firstMove($move)->secondMove($move);

   assertNull($this->game->getWinner());
})->with(['rock', 'paper', 'scissors']);
