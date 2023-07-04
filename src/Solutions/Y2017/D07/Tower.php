<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D07;

final readonly class Tower
{
    public static function of(Program $root, Tower|Program ...$items): self
    {
        return new self($root, $items);
    }

    private function __construct(public Program $root, public array $items)
    {
    }

    public function toTree(): array
    {
        return [
            $this->root->name => array_merge(
                ...
                array_map(
                    static fn (Program|Tower $item) => $item->toTree(),
                    $this->items,
                ),
            ),
        ];
    }
}
