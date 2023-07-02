<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D21\Operations;

final readonly class RotateRight implements Operation
{
    public static function of(int $steps): self
    {
        return new self($steps);
    }

    private function __construct(private int $steps)
    {
        assert($this->steps > 0);
    }

    public function apply(string $input): string
    {
        $size = $this->steps % strlen($input);
        return substr($input, -$size) . substr($input, 0, -$size);
    }

    public function __toString(): string
    {
        return "rotate right $this->steps steps";
    }
}
