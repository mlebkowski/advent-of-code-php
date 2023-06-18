<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\Molecule\Parser\Group;
use App\Solutions\Y2015\D19\Molecule\Problems\FoldingImpossible;
use loophp\collection\Collection;

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

    /**
     * @throws FoldingImpossible
     * @throws Problems\ProtomoleculeSpreadToEros
     */
    public function fold(Parser\Token $input): BasicElement
    {
        $stepsBefore = $this->steps;
        if ($input instanceof Element) {
            return $input;
        }

        $originalInput = $input;
        if ($input instanceof Group) {
            $input = $input->intoFoldable($this);
        }

        $instruction = Collection::fromIterable($this->instructions)->find(
            callbacks: static fn (FoldingInstruction $instruction) => $instruction->handles($input),
        );

        if (false === $instruction instanceof FoldingInstruction) {
            throw FoldingImpossible::ofToken($input, $this->steps + 1);
        }

        $this->steps++;
        return $instruction->into;
    }

    public function stepsCount(): int
    {
        return $this->steps;
    }
}
