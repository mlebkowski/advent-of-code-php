<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\RegisterSet;

final readonly class Muli implements D16Instruction
{
    public static function of(D16Register $source, int $value, D16Register $target): self
    {
        return new self($source, $value, $target);
    }

    private function __construct(
        private D16Register $source,
        private int $value,
        private D16Register $target,
    ) {
    }

    public function call(RegisterSet $input): RegisterSet
    {
        $value = $input->get($this->source) * $this->value;
        return $input->withRegisterValue($this->target, $value);
    }
}
