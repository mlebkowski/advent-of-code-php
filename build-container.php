#!/usr/bin/env php
<?php

declare(strict_types=1);

use App\Aoc\Discovery\ImplementationsDiscovery;
use App\Aoc\Runner\InputParser;
use App\Aoc\Solution;
use loophp\collection\Collection;

require_once './vendor/autoload.php';

/** @var ImplementationsDiscovery $implementationsDiscovery */
$implementationsDiscovery = require __DIR__ . '/config/implementationsDiscovery.php';

$map = [
    InputParser::class => __DIR__ . '/config/cache/inputParsers.php',
    Solution::class => __DIR__ . '/config/cache/solutions.php',
];

foreach ($map as $type => $target) {
    is_dir($dir = dirname($target)) || mkdir($dir, recursive: true);
    $implementations = Collection::fromIterable($implementationsDiscovery->findImplementations($type))
        ->sort(
            callback: static fn (ReflectionClass $alpha, ReflectionClass $bravo) => $alpha->getName() <=> $bravo->getName(),
        );

    $uses = $implementations
        ->map(static fn (ReflectionClass $class) => sprintf('use %s;', $class->getName()))
        ->implode("\n");

    $contents = $implementations
        ->map(static fn (ReflectionClass $class) => sprintf('  %s::class,', $class->getShortName()))
        ->implode("\n");
    file_put_contents(
        $target,
        sprintf(
            <<<EOF
            <?php
            declare(strict_types=1);
            
            %s
            
            return [
            %s
            ];
            
            EOF,
            $uses,
            $contents,
        ),
    );
}
