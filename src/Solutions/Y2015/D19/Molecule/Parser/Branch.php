<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D19\Molecule\Parser;

use IteratorAggregate;
use Stringable;
use Traversable;

final readonly class Branch implements Token, IteratorAggregate, Stringable
{
    public static function autoCollapse(Token ...$tokens): Token
    {
        if (1 === count($tokens)) {
            return reset($tokens);
        }

        return self::of(...$tokens);
    }

    public static function of(Token ...$tokens): self
    {
        return new self($tokens);
    }

    public function __construct(private array $tokens)
    {
        assert(count($this->tokens) >= 2);
    }

    public function getIterator(): Traversable
    {
        yield from $this->tokens;
    }

    public function __toString(): string
    {
        return sprintf('{%s}', implode(' | ', $this->tokens));
    }
}
