<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D14;

use App\Realms\Cartography\Map;
use App\Realms\Passwords\KnotHashBuilder;
use loophp\collection\Collection;

final class DiskBuilder
{
    public static function fromKeyString(string $keyString): Map
    {
        $builder = KnotHashBuilder::standard();
        $hexToBinary = static fn (string $string) => Collection::fromString($string)
            ->map(static fn (string $char) => str_pad(decbin(hexdec($char)), 4, '0', STR_PAD_LEFT))
            ->implode();

        $map = Collection::range(0, 0x80)
            ->map(static fn (float $row) => sprintf('%s-%d', $keyString, $row))
            ->map(static fn (string $key) => $builder->build($key)->denseHash)
            ->map($hexToBinary(...))
            ->map(static fn (string $string) => strtr($string, ['0' => '.', '1' => '#']))
            ->implode("\n");

        return Map::fromString($map);
    }
}
