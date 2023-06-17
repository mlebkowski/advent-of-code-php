<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use loophp\collection\Collection;
use RuntimeException;

final class FoldingProcess
{
    private int $steps = 0;

    public static function ofInstructions(FoldingInstruction ...$instructions): self
    {
        return new self($instructions);
    }

    private function __construct(private readonly array $instructions)
    {
    }

    public function fold(Compound|Particle|Pair|Branch $input): Element|Protomolecule
    {
        // todo: branch. before or after unfolding Pair? :-/ does it matter?
        if ($input instanceof Pair) {
            $input = $input->intoCompound($this);
        }

        if ($input instanceof Branch) {
            $input = $input->intoParticle($this);
        }

        $instruction = Collection::fromIterable($this->instructions)->find(
            callbacks: static fn (FoldingInstruction $instruction) => $instruction->handles($input),
        );

        if (false === $instruction instanceof FoldingInstruction) {
            throw new RuntimeException("Cannot fold $input");
        }

        $this->steps++;
        return $instruction->into;
    }

    public function stepsCount(): int
    {
        return $this->steps;
    }
}
