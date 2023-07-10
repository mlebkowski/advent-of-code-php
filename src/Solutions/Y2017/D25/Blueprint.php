<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use Stringable;

final readonly class Blueprint implements Stringable
{
    public static function of(string $startingState, int $checksumAfter, State ...$states): self
    {
        return new self($startingState, $checksumAfter, $states);
    }

    private function __construct(
        public string $startingState,
        public int $checksumAfter,
        public array $states,
    ) {
    }

    public function __toString(): string
    {
        $states = implode("\n\n", $this->states);
        return <<<EOF
        Begin in state $this->startingState.
        Perform a diagnostic checksum after $this->checksumAfter steps.

        $states
        EOF;
    }
}
