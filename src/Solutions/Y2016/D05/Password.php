<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D05;

final class Password
{
    private const Length = 8;

    private array $value = [];

    public static function ofSimpleStrategy(): self
    {
        return new self(useSimpleStrategy: true);
    }

    public static function ofSlightlyMoreInspiredSecurityMechanism(): self
    {
        return new self(useSimpleStrategy: false);
    }

    private function __construct(private readonly bool $useSimpleStrategy)
    {
    }

    public function update(string $hash): string
    {
        if ($this->useSimpleStrategy) {
            $this->value[] = $hash[0];
            return $this->value();
        }

        $idx = $hash[0];
        if (0 <= $idx && $idx < self::Length && false === isset($this->value[$idx])) {
            $this->value[$idx] = $hash[1];
        }

        return $this->value();
    }

    public function progress(string $hash): string
    {
        $hash = substr($hash, 0, self::Length);
        foreach ($this->value as $idx => $char) {
            $hash[$idx] = $char;
        }
        return $hash;
    }

    public function value(): string
    {
        return $this->progress('********');
    }
}
