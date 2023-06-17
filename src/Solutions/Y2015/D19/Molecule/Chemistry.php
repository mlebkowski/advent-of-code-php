<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule;

// todo, not used
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
}
