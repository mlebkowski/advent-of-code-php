<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use loophp\collection\Collection;

final readonly class Chemistry
{
    public function __construct(
        public Protomolecule $protomolecule,
        /** @var Element[] */
        public array $elements,
        /** @var FoldingInstruction[] */
        public array $instructions,
    ) {
    }

    public function makeDerivative(): Chemistry
    {
        $allowedElementNames = $this->getAllowedElementNames();

        $contains = static fn (BasicElement $element) => $element instanceof Element
            && in_array($element->name, $allowedElementNames, true);

        $elements = Collection::fromIterable($this->elements)
            ->filter(static fn (BasicElement $element) => $contains($element))
            ->all(false);

        $instructions = Collection::fromIterable($this->instructions)
            ->filter(static fn (FoldingInstruction $instruction) => $contains($instruction->into))
            ->all();

        return new self(
            $this->protomolecule,
            $elements,
            $instructions,
        );
    }

    private function getAllowedElementNames(): array
    {
        $elementNamesInComplexStructures = Collection::fromIterable($this->instructions)
            ->map(static fn (FoldingInstruction $instruction) => $instruction->foldable)
            ->filter(static fn (Foldable $foldable) => $foldable instanceof Particle)
            ->flatMap(static fn (Particle $particle) => $particle->elements)
            ->map(static fn (Element $element) => $element->name)
            ->distinct()
            ->all();

        $allowedElementNames = $this->findElementNamesInInstructions(
            $elementNamesInComplexStructures,
        );

        return $this->findElementNamesInInstructions($allowedElementNames);
    }

    private function findElementNamesInInstructions(array $whitelist): array
    {
        $isAllowed = static fn (BasicElement $element) => $element instanceof Element
            && in_array($element->name, $whitelist, true);

        return Collection::fromIterable($this->instructions)
            ->filter(static fn (FoldingInstruction $instruction) => $isAllowed($instruction->into))
            ->map(static fn (FoldingInstruction $instruction) => $instruction->foldable)
            ->filter(static fn (Foldable $foldable) => $foldable instanceof Compound)
            ->flatMap(static fn (Compound $compound) => [$compound->alpha, $compound->bravo])
            ->map(static fn (Element $element) => $element->name)
            ->merge($whitelist)
            ->distinct()
            ->all();
    }
}
