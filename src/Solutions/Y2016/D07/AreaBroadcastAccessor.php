<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D07;

use Stringable;

final readonly class AreaBroadcastAccessor implements Stringable
{
    public static function in(string $sequence): iterable
    {
        for ($i = 0; $i < strlen($sequence) - 2; $i++) {
            $outer = $sequence[$i];
            $inner = $sequence[$i + 1];
            $check = $sequence[$i + 2];
            if ($outer === $check && $outer !== $inner) {
                yield AreaBroadcastAccessor::of($outer, $inner);
            }
        }
    }

    public static function of(string $outer, string $inner): self
    {
        return new self($outer, $inner);
    }

    private function __construct(private string $outer, private string $inner)
    {
        assert(strlen($this->outer) === 1);
        assert(strlen($this->inner) === 1);
    }

    public function toByteAllocationBlock(): ByteAllocationBlock
    {
        return ByteAllocationBlock::of($this->inner, $this->outer);
    }

    public function __toString(): string
    {
        return $this->outer . $this->inner . $this->outer;
    }
}
