<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Realms\Cartography\Point;

final class WaterPool
{
    public array $set = [];

    public static function empty(string $type): self
    {
        return new self($type);
    }

    private function __construct(private readonly string $type)
    {
    }

    public function add(Point ...$points): iterable
    {
        foreach ($points as $point) {
            $this->set[(string)$point] = true;
        }
        foreach ($points as $x) {
            yield $this->type => $x;
        }
    }

    public function contains(Point $point): bool
    {
        return isset($this->set[(string)$point]);
    }

    public function count(): int
    {
        return count($this->set);
    }

    public function merge(WaterPool $other): self
    {
        $result = self::empty($this->type);
        $result->set = $this->set + $other->set;
        return $result;
    }
}
