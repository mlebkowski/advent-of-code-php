<?php

declare(strict_types=1);

namespace App\Realms\RolePlaying\Magic\Cleanup;

use App\Realms\RolePlaying\Character;

final readonly class ReduceArmor implements Cleanup
{
    public static function of(int $value, Character $character): self
    {
        return new self($value, $character);
    }

    private function __construct(private int $value, private Character $character)
    {
    }

    public function apply(): void
    {
        $this->character->reduceArmor($this->value);
    }

    public function __toString(): string
    {
        return sprintf('decreases armor by %d', $this->value);
    }
}
