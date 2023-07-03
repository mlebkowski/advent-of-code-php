<?php
declare(strict_types=1);

namespace App\Realms\Computing\Instruction;

use App\Realms\Computing\Instruction\Factory\ArgumentFactory;
use App\Realms\Computing\Instruction\Factory\Problems\UnexpectedArgument;
use App\Realms\Computing\Processor\Processor;
use App\Realms\Computing\Processor\Register;

final readonly class Toggle implements Instruction
{
    public static function of(Register $register): self
    {
        return new self($register);
    }

    private function __construct(private Register $register)
    {
    }

    public function apply(Processor $processor): void
    {
        // off by one! remember, the processor already advanced the cursor by now!
        $offset = $processor->cursor() - 1 + $processor->readRegister($this->register);
        $instruction = $processor->readInstruction($offset);
        if (null === $instruction) {
            return;
        }

        try {
            $instruction = $this->toggle($instruction);
        } catch (UnexpectedArgument) {
            $instruction = Noop::instruction();
        }

        $processor->updateInstruction($offset, $instruction);
    }

    /**
     * @throws UnexpectedArgument
     */
    private function toggle(Instruction $instruction): Instruction
    {
        [$name, $alpha, $bravo] = array_pad(explode(" ", (string)$instruction), 3, null);
        if ($bravo) {
            return match ($name) {
                'jnz' => Copy::of(
                    ArgumentFactory::registerOrValue($alpha),
                    ArgumentFactory::expectRegister($bravo),
                ),
                default => JumpNotZero::of(
                    ArgumentFactory::registerOrValue($alpha),
                    ArgumentFactory::registerOrValue($bravo),
                ),
            };
        }

        return match ($name) {
            'inc' => Dec::of(ArgumentFactory::expectRegister($alpha)),
            default => Inc::of(ArgumentFactory::expectRegister($alpha)),
        };
    }

    public function __toString(): string
    {
        $register = $this->register->value;
        return "tgl $register";
    }
}
