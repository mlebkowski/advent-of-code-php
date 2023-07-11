<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

final class NodeBuilder
{
    public static function fromStream(InputStream $numbers): Node
    {
        $childNodesCount = $numbers->next();
        $metadataEntriesCount = $numbers->next();

        $childNodes = $childNodesCount ? array_map(
            static fn () => self::fromStream($numbers),
            range(1, $childNodesCount),
        ) : [];

        $metadataEntries = $metadataEntriesCount ? array_map(
            static fn () => $numbers->next(),
            range(1, $metadataEntriesCount),
        ) : [];

        return Node::of($metadataEntries, ...$childNodes);
    }
}
