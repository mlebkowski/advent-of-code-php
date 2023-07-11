<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

final readonly class Node
{
    public static function of(array $metadata, Node ...$children): self
    {
        return new self($metadata, $children);
    }

    private function __construct(private array $metadata, private array $children)
    {
    }

    public function sumMetadata(): int
    {
        return array_sum([
            ...$this->metadata,
            ...array_map(
                static fn (Node $node) => $node->sumMetadata(),
                $this->children,
            ),
        ]);
    }
}
