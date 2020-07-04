<?php

declare(strict_types=1);

namespace App;

final class Bob
{
    public const RESPONSE_DEFAULT = 'Whatever.';
    public const RESPONSE_SAY_NOTHING = 'Fine. Be that way!';
    public const RESPONSE_QUESTION = 'Sure.';
    public const RESPONSE_YELLING = 'Whoa, chill out!';
    public const RESPONSE_YELLING_QUESTION = 'Calm down, I know what I\'m doing!';

    private string $input;

    public static function saySomethingTo(string $input): self
    {
        return new self($input);
    }

    public function getResponse(): string
    {
        if ($this->input === '') {
            return self::RESPONSE_SAY_NOTHING;
        }

        if ($this->isQuestion() && $this->isYelling()) {
            return self::RESPONSE_YELLING_QUESTION;
        }

        if ($this->isQuestion()) {
            return self::RESPONSE_QUESTION;
        }

        if ($this->isYelling()) {
            return self::RESPONSE_YELLING;
        }

        return self::RESPONSE_DEFAULT;
    }

    final private function __construct(string $input)
    {
        $this->input = $input;
    }

    private function isQuestion(): bool
    {
        return (bool) preg_match('/.+\?/', $this->input);
    }

    private function isYelling(): bool
    {
        return (bool) preg_match('/.+!/', $this->input);
    }
}
