<?php

declare(strict_types=1);

namespace App\Aoc;

final readonly class InputFetcher
{
    public function __construct(
        private string $cachePath,
        private string $sessionKey,
    ) {
    }

    public function fetch(Challenge $challenge): Input
    {
        $fileBasePath = sprintf(
            '%s/%d-%d',
            $this->cachePath,
            $challenge->year,
            $challenge->day,
        );

        $inputPath = sprintf('%s.txt', $fileBasePath);
        $samplePath = sprintf('%s-%d-%s.txt', $fileBasePath, $challenge->part->value, 'sample');
        $expectedPath = sprintf('%s-%d-%s.txt', $fileBasePath, $challenge->part->value, 'expected');

        file_exists($samplePath) || touch($samplePath);
        file_exists($expectedPath) || touch($expectedPath);

        if (false === file_exists($inputPath)) {
            is_dir(dirname($inputPath)) || mkdir(dirname($inputPath), recursive: true);
            $url = sprintf(
                'https://adventofcode.com/%d/day/%d/input',
                $challenge->year,
                $challenge->day,
            );
            $context = stream_context_create([
                'http' => [
                    'header' => sprintf('Cookie: session=%s', $this->sessionKey),
                ],
            ]);

            file_put_contents($inputPath, file_get_contents($url, context: $context));
        }

        return Input::of(
            file_get_contents($inputPath),
            file_get_contents($samplePath),
            file_get_contents($expectedPath),
        );
    }
}
