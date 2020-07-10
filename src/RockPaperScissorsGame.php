<?php

namespace App;

use Assert\Assert;
use Tightenco\Collect\Support\Collection;

class RockPaperScissorsGame
{
    private const MOVE_ROCK = 'rock';
    private const MOVE_PAPER = 'paper';
    private const MOVE_SCISSORS = 'scissors';

    private static array $possibleMoves = [
        [
            'moves' => [self::MOVE_ROCK, self::MOVE_PAPER],
            'winner' => self::MOVE_PAPER,
        ],
        [
            'moves' => [self::MOVE_ROCK, self::MOVE_SCISSORS],
            'winner' => self::MOVE_SCISSORS,
        ],
        [
            'moves' => [self::MOVE_PAPER, self::MOVE_SCISSORS],
            'winner' => self::MOVE_SCISSORS,
        ],
    ];

    private Collection $moves;

    public function __construct()
    {
        $this->moves = new Collection();
    }

    public function firstMove(string $move): self
    {
        $this->validateMoveIsValid($move);
        $this->moves[0] = $move;

        return $this;
    }

    public function secondMove(string $move): self
    {
        $this->validateMoveIsValid($move);
        $this->moves[1] = $move;

        return $this;
    }

    public function getWinner(): ?string
    {
        if ($this->moves[0] == $this->moves[1]) {
            return null;
        }

        $move = (new Collection(self::$possibleMoves))
            ->first(function (array $move): bool {
                // Determine if the played moves match this combination of
                // possible moves.
                return $this->moves->diff($move['moves'])->isEmpty();
            });

        return $move['winner'];
    }

    private function validateMoveIsValid(string $move): void
    {
        Assert::that($move)
            ->notEmpty('You must specify a move.')
            ->inArray(
                [self::MOVE_ROCK, self::MOVE_PAPER, self::MOVE_SCISSORS],
                'You must enter a valid move. %s given.'
            );
    }
}
