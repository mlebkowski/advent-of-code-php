<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D24;

use Generator;

final readonly class BridgeBuilder
{
    public static function of(Component ...$components): self
    {
        return new self($components);
    }

    private function __construct(private array $components)
    {
    }

    public function build(): Generator
    {
        yield from $this->extendBridge(Bridge::empty());
    }

    private function extendBridge(Bridge $bridge): iterable
    {
        foreach ($this->components as $component) {
            if ($bridge->fits($component)) {
                yield from self::extendWithComponent($bridge, $component);
            } elseif ($bridge->fits($component->flip())) {
                yield from self::extendWithComponent($bridge, $component->flip());
            }
        }
    }

    private function extendWithComponent(Bridge $bridge, Component $component): iterable
    {
        $extended = $bridge->extend($component);
        yield $extended;
        yield from self::extendBridge($extended);
    }
}
