<?php
declare(strict_types=1);

namespace App\Solutions\Y2017\D25;

use Stringable;

final readonly class State implements Stringable
{
    public static function of(string $name, Rule $offRule, Rule $onRule): self
    {
        return new self($name, $offRule, $onRule);
    }

    private function __construct(public string $name, public Rule $offRule, public Rule $onRule)
    {
    }

    public function __toString(): string
    {
        return <<<EOF
        In state $this->name:
          If the current value is 0:
        $this->offRule
          If the current value is 1:
        $this->onRule
        EOF;
    }
}
