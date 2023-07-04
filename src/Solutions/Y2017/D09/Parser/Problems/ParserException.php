<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser\Problems;

use Exception;

final class ParserException extends Exception
{
    public static function of(int $offset, string $message): self
    {
        return new self($offset, $message);
    }

    private function __construct(public readonly int $offset, string $message)
    {
        parent::__construct("$offset: $message");
    }
}
