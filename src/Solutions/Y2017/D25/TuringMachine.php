<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use loophp\collection\Collection;

final class TuringMachine
{
    private string $currentState;
    /** @var State[] */
    private readonly array $states;

    public static function some(Blueprint $blueprint): self
    {
        return new self(Cursor::starting(), Tape::empty(), $blueprint);
    }

    private function __construct(
        private readonly Cursor $cursor,
        private readonly Tape $tape,
        Blueprint $blueprint,
    ) {
        $this->currentState = $blueprint->startingState;
        $this->states = Collection::fromIterable($blueprint->states)
            ->map(static fn (State $state) => [$state->name, $state])
            ->unpack()
            ->all(false);
    }

    public function step(): void
    {
        $currentValue = $this->tape->read($this->cursor);
        $state = $this->states[$this->currentState];
        $rule = match ($currentValue) {
            Value::Off => $state->offRule,
            Value::On => $state->onRule,
        };
        $this->tape->write($this->cursor, $rule->write);
        $this->cursor->move($rule->direction);
        $this->currentState = $rule->nextState;
    }

    public function diagnosticChecksum(): int
    {
        return $this->tape->diagnosticChecksum();
    }
}
