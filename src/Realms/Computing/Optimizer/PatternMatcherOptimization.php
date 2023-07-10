<?php
declare(strict_types=1);

namespace App\Realms\Computing\Optimizer;

use App\Realms\Computing\Instruction\Instruction;
use App\Realms\Computing\Instruction\Noop;
use Closure;

final readonly class PatternMatcherOptimization implements Optimization
{
    public static function of(string $pattern, Closure $replacement): self
    {
        return new self(PatternMatcher::of($pattern), 1 + substr_count($pattern, "\n"), $replacement);
    }

    private function __construct(private PatternMatcher $matcher, private int $length, private Closure $factory)
    {
    }

    public function optimize(Instruction ...$instructions): array
    {
        $result = $instructions;
        foreach ($instructions as $idx => $instruction) {
            $chunk = array_slice($instructions, $idx, $this->length);
            $replacement = $this->detectedPattern($chunk);
            if ($replacement) {
                array_splice($result, $idx, $this->length, $replacement);
            }
        }
        return $result;
    }

    private function detectedPattern(array $chunk): false|array
    {
        $matches = $this->matcher->match(...$chunk);
        if (!$matches) {
            return false;
        }
        return array_pad(($this->factory)($matches), $this->length, Noop::instruction());
    }
}
