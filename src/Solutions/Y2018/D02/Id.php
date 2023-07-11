<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D02;

use loophp\collection\Collection;

final readonly class Id
{
    private array $frequencies;

    public static function of(string $value): self
    {
        return new self($value);
    }

    private function __construct(public string $value)
    {
        $this->frequencies = Collection::fromString($this->value)
            ->frequency()
            ->keys()
            ->all();
    }

    public function hasExactlyNumberOfAnyLetter(int $n): bool
    {
        return in_array($n, $this->frequencies, true);
    }

    public function withoutNthLetter(int $idx): self
    {
        return new self(
            substr_replace($this->value, '', $idx, 1),
        );
    }
}
