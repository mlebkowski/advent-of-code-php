<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19;

final readonly class NuclearMedicineInput
{
    public static function of(string $molecule, Replacement ...$replacements): self
    {
        return new self($molecule, $replacements);
    }

    public function __construct(public string $molecule, public array $replacements)
    {
    }
}
