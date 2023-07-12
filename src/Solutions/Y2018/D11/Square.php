<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D11;

final readonly class Square
{
    public string $id;

    public static function of(int $x, int $y, int $size, int $powerlevel): self
    {
        return new self($x, $y, $size, $powerlevel);
    }

    private function __construct(public int $x, public int $y, public int $size, public int $powerlevel)
    {
        $this->id = "$x,$y" . (($this->size !== 3) ? ",$size" : '');
    }

    public function toArray(): array
    {
        return get_object_vars($this);
    }
}
