<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D01;

use App\Lib\Generators\LoopedSequence;
use loophp\collection\Collection;

final readonly class FrequencySequence
{
    public static function ofChanges(array $sequence): self
    {
        return new self($sequence);
    }

    private function __construct(private array $sequence)
    {

    }

    public function stream(): Collection
    {
        $emitter = FrequencyEmitter::of();
        return Collection::fromGenerator(LoopedSequence::of($this->sequence))->map($emitter->emit(...));
    }

    public function nth(int $n): int
    {
        if ($n === 0) {
            return 0;
        }

        return $this->stream()->slice($n - 1)->first();
    }
}
