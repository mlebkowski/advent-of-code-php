<?php
declare(strict_types=1);

namespace App\Realms\Passwords;

final class KnotHashBuilder
{
    private int $iterations = 64;
    private int $listLength = 0xFF;
    private array $lengthsToAdd = [17, 31, 73, 47, 23];

    public static function standard(): self
    {
        return new self();
    }

    private function __construct()
    {
    }

    public function withoutIterations(): self
    {
        $this->iterations = 1;
        return $this;
    }

    public function withListLength(int $length): self
    {
        assert(0 < $length && $length <= 0xFF);
        $this->listLength = $length;
        return $this;
    }

    public function withoutAddedLengths(): self
    {
        $this->lengthsToAdd = [];
        return $this;
    }

    public function build(string $input): KnotHash
    {
        return KnotHashFactory::make($input, $this->iterations, $this->lengthsToAdd, $this->listLength);
    }
}
