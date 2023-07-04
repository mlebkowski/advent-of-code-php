<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

use App\Solutions\Y2017\D09\Parser\Problems\ParserException;
use Iterator;
use SplFixedArray;

final readonly class InputStream
{
    private Iterator $iterator;

    public static function of(string $input): self
    {
        return new self(SplFixedArray::fromArray(str_split($input)));
    }

    private function __construct(private SplFixedArray $buffer)
    {
        $this->iterator = $buffer->getIterator();
    }

    public function peek(): string
    {
        $index = $this->iterator->key();
        return $this->buffer->offsetGet($index);
    }

    public function next(): string
    {
        $chr = $this->iterator->current();
        $this->iterator->next();
        return $chr;
    }

    public function eof(): bool
    {
        return "" === $this->peek();
    }

    /**
     * @throws ParserException
     */
    public function croak(string $message): never
    {
        throw ParserException::of($this->iterator->key(), $message);
    }
}
