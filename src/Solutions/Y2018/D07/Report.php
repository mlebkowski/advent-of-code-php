<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

final readonly class Report
{
    public static function of(string $assemblyOrder, string $completeOrder, int $time): self
    {
        return new self($assemblyOrder, $completeOrder, $time);
    }

    private function __construct(public string $assemblyOrder, public string $completeOrder, public int $time)
    {
    }
}
