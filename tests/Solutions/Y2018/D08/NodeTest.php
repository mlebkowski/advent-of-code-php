<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

use PHPUnit\Framework\TestCase;

final class NodeTest extends TestCase
{
    public function test value without children(): void
    {
        $given = Node::of([10, 11, 12]);
        self::assertSame(33, $given->value());
    }

    public function test value with unreferenced children(): void
    {
        $given = Node::of([2], Node::of([99]));
        self::assertSame(0, $given->value());
    }

    public function test value with existing children(): void
    {
        $given = Node::of(
            [1, 1, 2],
            Node::of([10, 11, 12]),
            Node::of([2], Node::of([99])),
        );
        self::assertSame(33 + 33 + 0, $given->value());
    }
}
