<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D16\Instructions;

use App\Solutions\Y2018\D16\D16Register;
use App\Solutions\Y2018\D16\RegisterSet;

final readonly class Setr implements D16Instruction
{
    public static function of(D16Register $source, D16Register $target): self
    {
        return new self($source, $target);
    }

    private function __construct(
        private D16Register $source,
        private D16Register $target,
    ) {
    }

    public function call(RegisterSet $input): RegisterSet
    {
        $value = $input->get($this->source);
        return $input->withRegisterValue($this->target, $value);
    }
}
