<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D04;

use loophp\collection\Collection;
use loophp\collection\Contract\Operation\Sortable;

final readonly class Room
{
    private const PartsSeparator = '-';

    public static function of(string $name, int $sectorId, string $checksum): self
    {
        return new self($name, $sectorId, $checksum);
    }

    public function __construct(public string $name, public int $sectorId, public string $checksum)
    {
    }

    public function decryptedName(): string
    {
        $base = ord('a');
        $space = ord('z') - $base + 1;
        $key = $this->sectorId % $space;
        return Collection::fromString($this->name)
            ->map(
                static fn (string $char) => $char === self::PartsSeparator
                    ? ' '
                    : chr((ord($char) - $base + $key) % $space + $base),
            )
            ->implode();
    }

    public function isValid(): bool
    {
        $checksum = Collection::fromString($this->name)
            ->frequency()
            ->reject(static fn (string $char) => $char === self::PartsSeparator)
            ->sort()
            ->reverse()
            ->sort(Sortable::BY_KEYS)
            ->reverse()
            ->slice(0, 5)
            ->implode();

        return $this->checksum === $checksum;
    }
}
