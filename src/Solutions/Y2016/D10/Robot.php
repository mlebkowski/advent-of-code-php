<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

final class Robot
{
    public static function empty(int $id): self
    {
        return new self($id, values: []);
    }

    public static function of(int $id, array $values): self
    {
        return new self($id, $values);
    }

    private function __construct(private readonly int $id, private array $values)
    {
        assert(count($values) <= 2);
    }

    public function isFull(): bool
    {
        return 2 === count($this->values);
    }

    public function transfer(): TransferOut
    {
        assert($this->isFull());
        sort($this->values);
        return TransferOut::of($this->id, ...array_splice($this->values, 0, 2));
    }

    public function take(int $value): void
    {
        assert(false === $this->isFull());
        $this->values[] = $value;
    }
}
