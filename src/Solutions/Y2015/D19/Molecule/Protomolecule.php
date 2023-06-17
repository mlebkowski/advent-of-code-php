<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

final class Protomolecule implements BasicElement
{
    private const ProtomoleculeSymbol = 'e';

    public static function is(Element $element): bool
    {
        return self::ProtomoleculeSymbol === $element->name;
    }

    public function __toString()
    {
        return self::ProtomoleculeSymbol;
    }
}
