<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use ArrayObject;

final readonly class Tape
{
    public static function empty(): self
    {
        return new self(new ArrayObject());
    }

    private function __construct(private ArrayObject $storage)
    {
    }

    public function write(Cursor $cursor, Value $value): void
    {
        $this->storage->offsetSet($cursor->position(), $value->value);
    }

    public function read(Cursor $cursor): Value
    {
        if (false === isset($this->storage[$cursor->position()])) {
            return Value::Off;
        }
        return Value::from($this->storage[$cursor->position()]);
    }

    public function diagnosticChecksum(): int
    {
        return array_sum($this->storage->getArrayCopy());
    }
}
