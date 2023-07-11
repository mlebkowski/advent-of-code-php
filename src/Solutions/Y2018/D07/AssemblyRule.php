<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

final readonly class AssemblyRule
{
    public static function of(string $requirement, string $step): self
    {
        return new self($requirement, $step);
    }

    private function __construct(public string $requirement, public string $step)
    {
    }
}
