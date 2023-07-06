<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

use Stringable;

final readonly class KnotHash implements Stringable
{
    public static function of(array $sparseHash, string $denseHash): self
    {
        return new self($sparseHash, $denseHash);
    }

    private function __construct(public array $sparseHash, public string $denseHash)
    {
    }

    public function __toString(): string
    {
        return $this->denseHash;
    }
}
