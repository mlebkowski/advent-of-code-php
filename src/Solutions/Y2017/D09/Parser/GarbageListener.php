<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D09\Parser;

final class GarbageListener
{
    private array $garbage;

    public static function empty(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function garbage(): array
    {
        return $this->garbage;
    }

    public function push(Token $token): void
    {
        assert($token->type === Type::Garbage);
        $this->garbage[] = $token->value;
    }
}
