<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

final readonly class Parenthesis
{
    public function __construct(public int $length, public string $leftPart, public array $arguments)
    {
        assert(strlen($this->leftPart) > 0);
        foreach ($this->arguments as $argument) {
            assert(strlen($argument) > 0);
        }
    }
}
