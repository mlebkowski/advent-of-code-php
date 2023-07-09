<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Realms\Cartography\Map;
use loophp\collection\Collection;

final readonly class EnchancementRule
{
    /** @var Map[] */
    private array $variants;

    public static function fromStrings(string $from, string $to): self
    {
        return self::of(
            Map::fromString(strtr($from, ["/" => "\n"])),
            Map::fromString(strtr($to, ["/" => "\n"])),
        );
    }

    public static function of(Map $from, Map $to): self
    {
        return new self($from, $to);
    }

    private function __construct(Map $from, public Map $to)
    {
        $this->variants = Collection::fromIterable([$from])
            ->flatMap(static fn (Map $map) => [$map, $map->rotate()->rotate()])
            ->flatMap(static fn (Map $map) => [$map, $map->rotate()])
            ->flatMap(static fn (Map $map) => [$map, $map->flipHorizontal()])
            ->all();
    }

    public function matches(Map $map): bool
    {
        foreach ($this->variants as $variant) {
            if ($variant->width === $map->width && (string)$variant === (string)$map) {
                return true;
            }
        }
        return false;
    }
}
