<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use loophp\collection\Collection;
use Stringable;

final readonly class Bridge implements Stringable
{
    private array $banned;

    public static function empty(): self
    {
        return new self([], 0);
    }

    private function __construct(/** @var Component[] */ private array $components, private int $expects)
    {
        $this->banned = Collection::fromIterable($this->components)
            ->flatMap(
                static fn (Component $component) => match ($expects) {
                    $component->out => $component->in,
                    $component->in => $component->out,
                    default => null,
                },
            )
            ->all();
    }

    public function fits(Component $component): bool
    {
        return $this->expects === $component->out
            && false === in_array($component->in, $this->banned, true);
    }

    public function extend(Component $component): self
    {
        assert($this->fits($component));
        return new self([...$this->components, $component], $component->in);
    }

    public function strength(): int
    {
        return array_reduce(
            $this->components,
            static fn (int $sum, Component $component) => $sum + $component->strength(),
            0,
        );
    }

    public function __toString(): string
    {
        return implode('--', $this->components);
    }
}
