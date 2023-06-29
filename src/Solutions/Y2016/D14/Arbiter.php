<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D14;

use App\Realms\Passwords\HashGenerator;
use Generator;
use loophp\collection\Collection;

final class Arbiter
{
    private array $rollingWindow = [];
    private array $confirmationTokens = [];
    private Generator $generator;
    private int $cursor = 0;

    public static function of(string $salt, int $lookaheadWindow): self
    {
        return new self($salt, $lookaheadWindow);
    }

    private function __construct(string $salt, private readonly int $lookaheadWindow)
    {
        $this->generator = HashGenerator::of($salt);
    }

    public function hasCounterpart(string $hash, int $index): bool
    {
        $this->lookahead($index);

        preg_match('/(.)\1\1/', $hash, $match);
        $confirmationToken = $match[1];

        return in_array($confirmationToken, $this->confirmationTokens, true);
    }

    private function lookahead(int $index): void
    {
        assert($index + $this->lookaheadWindow > $this->cursor);

        $extractConfirmationToken = static function (string $hash) {
            preg_match_all('/(?P<token>.)\1{4}/', $hash, $m);
            return $m['token'];
        };

        $target = $index + $this->lookaheadWindow;
        $difference = $target - $this->cursor;
        $gap = $index - $this->cursor;
        //  |--------[$i]---800-----------------[$c]---200---[$t]-->
        //            $gap = -800, $difference = 200,
        //  |--------[$c]---200---[$i]---1 000---------------[$t]-->
        //            $gap = 200, $difference = 1200,
        $this->rollingWindow = Collection::fromGenerator($this->generator)
            ->slice(
                max(0, $gap),
                min($this->lookaheadWindow, $difference),
            )
            ->map($extractConfirmationToken)
            ->merge($this->rollingWindow)
            ->filter(static fn ($value, int $idx) => $idx > $index)
            ->all(false);

        $this->confirmationTokens = Collection::fromIterable($this->rollingWindow)
            ->flatten()
            ->distinct()
            ->all();

        $this->cursor = $target;
    }
}
