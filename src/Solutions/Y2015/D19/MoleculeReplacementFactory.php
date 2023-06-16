<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

final readonly class MoleculeReplacementFactory
{
    public static function of(string $molecule): self
    {
        return new self($molecule);
    }

    private function __construct(private string $molecule)
    {
    }

    public function generateReplacements(Replacement $replacement): iterable
    {
        $base = '';
        $molecule = $this->molecule;

        while ($base !== $molecule) {
            $offset = strpos($molecule, $replacement->from);
            if (false === $offset) {
                return;
            }

            $base .= substr($molecule, 0, $offset);
            $molecule = substr($molecule, $offset + strlen($replacement->from));
            yield $base . $replacement->to . $molecule;
            $base .= $replacement->from;
        }
    }
}
