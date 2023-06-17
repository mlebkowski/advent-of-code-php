<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final class Protomolecule implements BasicElement
{
    private const ProtomoleculeSymbol = 'e';

    public static function fromPhoebe(): self
    {
        return new self();
    }

    public static function is(BasicElement $element): bool
    {
        if ($element instanceof Element) {
            return self::ProtomoleculeSymbol === $element->name;
        }

        return $element instanceof self;
    }

    private function __construct()
    {
    }

    public function __toString()
    {
        return self::ProtomoleculeSymbol;
    }
}
