<?php
declare(strict_types=1);

namespace App\Realms\Computing\IO;

final readonly class StreamCopy implements OutputDevice
{
    public static function of(OutputDevice $other): self
    {
        return new self(new Stdout(), $other);
    }

    private function __construct(private OutputDevice $storage, public OutputDevice $other)
    {
    }

    public function write(mixed $value): void
    {
        $this->storage->write($value);
        $this->other->write($value);
    }

    public function consumeOutputBuffer(): iterable
    {
        return $this->storage->consumeOutputBuffer();
    }
}
