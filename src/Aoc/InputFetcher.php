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
            '%s/%d-%d-%d',
            $this->cachePath,
            $challenge->year,
            $challenge->day,
            $challenge->part,
        );

        $inputPath = $fileBasePath . '.txt';
        $samplePath = $fileBasePath . '-sample.txt';
        $expectedPath = $fileBasePath . '-expected.txt';

        if (false === file_exists($inputPath)) {
            mkdir(dirname($inputPath), recursive: true);
            touch($samplePath);
            touch($expectedPath);
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
