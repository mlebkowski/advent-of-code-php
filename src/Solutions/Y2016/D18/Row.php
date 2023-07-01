<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use Stringable;

final readonly class Row implements Stringable
{
    public static function fromString(string $row): self
    {
        return self::of(trim($row));
    }

    public static function of(string $value): self
    {
        return new self($value);
    }

    private function __construct(private string $value)
    {
    }

    public function next(): Row
    {
        $source = ".$this->value.";
        $max = strlen($source) - 1;
        $row = '';
        for ($i = 1; $i < $max; $i++) {
            $row .= ($source[$i - 1] === $source[$i]) === ($source[$i] !== $source[$i + 1]) ? '^' : '.';
        }
        return self::of($row);
    }

    public function safeTileCount(): int
    {
        return substr_count($this->value, '.');
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
