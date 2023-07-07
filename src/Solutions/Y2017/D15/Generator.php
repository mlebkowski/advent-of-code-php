<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D15;

final readonly class Generator
{
    public static function of(GeneratorType $type, int $startingValue): self
    {
        return new self($type, $startingValue);
    }

    private function __construct(private GeneratorType $type, private int $startingValue)
    {
    }

    public function generate(bool $picky = false): iterable
    {
        $value = $this->startingValue;
        $factor = $this->type->factor();
        $k = $this->type->multiples();
        $n = 2 ** 31 - 1;
        while (true) {
            $value = ($value * $factor) % $n;
            if (false === ($picky && $value % $k)) {
                yield $value;
            }
        }
    }

}
