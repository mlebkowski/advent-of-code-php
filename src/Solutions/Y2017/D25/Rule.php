<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use Stringable;

final readonly class Rule implements Stringable
{
    public static function of(Value $write, TapeDirection $direction, string $nextState): self
    {
        return new self($write, $direction, $nextState);
    }

    private function __construct(public Value $write, public TapeDirection $direction, public string $nextState)
    {
    }

    public function __toString(): string
    {
        return <<<EOF
            - Write the value {$this->write->value}.
            - Move one slot to the {$this->direction->value}.
            - Continue with state $this->nextState.
        EOF;
    }
}
