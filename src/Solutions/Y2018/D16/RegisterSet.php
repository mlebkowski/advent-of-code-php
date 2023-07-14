<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16;

final readonly class RegisterSet
{
    public static function of(int $alpha, int $bravo, int $charlie, int $delta): self
    {
        return new self($alpha, $bravo, $charlie, $delta);
    }

    private function __construct(
        public int $alpha,
        public int $bravo,
        public int $charlie,
        public int $delta,
    ) {
    }

    public function equals(self $other): bool
    {
        return $this->alpha === $other->alpha
            && $this->bravo === $other->bravo
            && $this->charlie === $other->charlie
            && $this->delta === $other->delta;
    }

    public function withRegisterValue(D16Register $register, int $value): self
    {
        return match ($register) {
            D16Register::Alpha => self::of($value, $this->bravo, $this->charlie, $this->delta),
            D16Register::Bravo => self::of($this->alpha, $value, $this->charlie, $this->delta),
            D16Register::Charlie => self::of($this->alpha, $this->bravo, $value, $this->delta),
            D16Register::Delta => self::of($this->alpha, $this->bravo, $this->charlie, $value),
        };
    }

    public function get(D16Register $register): int
    {
        return match ($register) {
            D16Register::Alpha => $this->alpha,
            D16Register::Bravo => $this->bravo,
            D16Register::Charlie => $this->charlie,
            D16Register::Delta => $this->delta,
        };
    }
}
