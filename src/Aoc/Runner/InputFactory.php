<?php

declare(strict_types=1);

namespace App\Aoc\Runner;

use App\Aoc\Discovery\ImplementationsDiscovery;
use loophp\collection\Collection;
use RuntimeException;

final readonly class InputFactory
{
    /** @var array<string,InputParser> */
    private array $parsers;

    public function __construct(ImplementationsDiscovery $discovery)
    {
        $this->parsers = Collection::fromIterable($discovery->findImplementations(InputParser::class))
            ->map(static fn (InputParser $parser) => [
                TargetClassEvaluator::getTargetClass($parser),
                $parser,
            ])
            ->unpack()
            ->all(false);
    }

    /**
     * @template T
     * @param class-string<T> $targetClass
     * @return T|string
     */
    public function make(string $input, string $targetClass): object|string
    {
        $parser = $this->parsers[$targetClass] ?? throw new RuntimeException(
            sprintf('Cant find parser for %s input', $targetClass),
        );
        return $parser->parse($input) ?? $input;
    }
}
