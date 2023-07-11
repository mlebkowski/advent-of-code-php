<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

final readonly class Node
{
    public static function of(array $metadata, Node ...$children): self
    {
        return new self($metadata, $children);
    }

    private function __construct(private array $metadata, /** @var Node[] */ private array $children)
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

    public function value(): int
    {
        if (0 === count($this->children)) {
            return array_sum($this->metadata);
        }

        return array_reduce(
            $this->metadata,
            fn (int $sum, int $idx) => $sum + $this->children($idx)->value(),
            0,
        );
    }

    private function children(int $at): Node
    {
        return $this->children[$at - 1] ?? Node::of([]);
    }
}
