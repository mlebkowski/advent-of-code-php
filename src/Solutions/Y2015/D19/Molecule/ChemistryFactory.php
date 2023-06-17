<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

use App\Solutions\Y2015\D19\Replacement;
use loophp\collection\Collection;

final class ChemistryFactory
{
    private const ParticleRe = '/^
        (?P<main>\w{1,2})
        Rn
        (?P<secondary>
            \w{1,2}
            (?:Y\w{1,2}){0,2}
        )
        Ar
    $/x';

    private array $elements = [];

    public static function ofReplacements(Replacement ...$replacements): Chemistry
    {
        return self::make()->create(...$replacements);
    }

    private function create(Replacement ...$replacements): Chemistry
    {
        $groupedReplacements = Collection::fromIterable($replacements)
            ->groupBy(static fn (Replacement $replacement) => $replacement->from);

        $this->elements = $groupedReplacements
            ->keys()
            ->map($this->createElement(...))
            ->sort(callback: static fn ($element) => $element instanceof Protomolecule ? 1 : 0)
            ->all(false);

        $instructions = $groupedReplacements
            ->flatMap($this->createInstructions(...))
            ->all();

        return new Chemistry(
            array_pop($this->elements),
            $this->elements,
            $instructions,
        );
    }

    private static function make(): self
    {
        return new self();
    }

    private function createInstructions(array $replacements, string $elementName): iterable
    {
        $element = $this->createElement($elementName);

        [$compounds, $particles] = Collection::fromIterable($replacements)
            ->map(static fn (Replacement $replacement) => $replacement->to)
            ->partition(static fn (string $value) => 0 === preg_match(self::ParticleRe, $value))
            ->all();

        return $compounds->map($this->compoundFromString(...))
            ->merge($particles->map($this->particleFromString(...)))
            ->map(static fn (Foldable $foldable) => FoldingInstruction::of($element, $foldable));
    }

    private function compoundFromString(string $compound): Compound
    {
        $elements = Collection::fromIterable($this->elements)
            ->filter(static fn ($element) => $element instanceof Element);

        $alpha = $elements
            ->find(callbacks: static fn (BasicElement $element) => str_starts_with(
                $compound,
                (string)$element,
            ));
        $bravo = $elements
            ->find(callbacks: static fn (BasicElement $element) => str_ends_with(
                $compound,
                (string)$element,
            ));

        assert(
            null !== $alpha && null !== $bravo && $compound === "$alpha$bravo",
            "Oops, something has gone wrong, cannot decode compound",
        );

        return Compound::of($alpha, $bravo);
    }

    private function particleFromString(string $particle): Particle
    {
        preg_match(self::ParticleRe, $particle, $matches);
        preg_match('/^(\w{1,2})(?:Y(\w{1,2}))?(?:Y(\w{1,2}))?$/', $matches['secondary'], $secondary);

        return Particle::of(
            $this->createElement($matches['main']),
            ...
            Collection::fromIterable($secondary)
                ->drop(1)
                ->map(fn (string $element) => $this->createElement($element))
                ->all(),
        );
    }

    private function createElement(string $name): BasicElement
    {
        $element = Element::of($name);
        if (Protomolecule::is($element)) {
            return new Protomolecule();
        }

        return $element;
    }
}
