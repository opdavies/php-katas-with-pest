<?php

declare(strict_types=1);

namespace App;

use Assert\Assert;
use Tightenco\Collect\Support\Collection;

final class BowlingGame
{
    private const MAX_PINS_PER_FRAME = 10;
    private const NUMBER_OF_FRAMES = 10;

    private Collection $rolls;

    public function __construct()
    {
        $this->rolls = new Collection();
    }

    public function roll(int $pins): void
    {
        Assert::that($pins)
            ->greaterOrEqualThan(0,
                'You cannot knock down a negative number of pins. Knocked down %d.')
            ->lessOrEqualThan(self::MAX_PINS_PER_FRAME,
                'You can only knock down a maximum of 10 pins in a roll. Knocked down 12.');

        $this->rolls->push($pins);
    }

    public function getScore(): int
    {
        $score = 0;
        $roll = 0;

        foreach (range(1, self::NUMBER_OF_FRAMES) as $frame) {
            if ($this->isStrike($roll)) {
                $score += $this->rolls[$roll];
                $score += $this->bonusForStrike($roll);

                $roll += 1;
                continue;
            }

            if ($this->isSpare($roll)) {
                $score += $this->defaultFrameScore($roll);
                $score += $this->bonusForSpare($roll);

                $roll += 2;
                continue;
            }

            $score += $this->defaultFrameScore($roll);

            $roll += 2;
        }

        return $score;
    }

    private function bonusForSpare(int $roll): int
    {
        return $this->rolls->get($roll + 2);
    }

    private function bonusForStrike(int $roll): int
    {
        return $this->rolls[$roll + 1] + $this->rolls[$roll + 2];
    }

    private function defaultFrameScore(int $roll): int
    {
        return $this->rolls[$roll] + $this->rolls[$roll + 1];
    }

    private function isSpare(int $roll): bool
    {
        return $this->defaultFrameScore($roll)
            == self::MAX_PINS_PER_FRAME;
    }

    private function isStrike(int $roll): bool
    {
        return $this->rolls[$roll] == self::MAX_PINS_PER_FRAME;
    }
}
