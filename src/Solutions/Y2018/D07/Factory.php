<?php
declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use Generator;

final readonly class Factory
{
    public static function of(int $stepDuration, int $workers): self
    {
        return new self($stepDuration, $workers);
    }

    private function __construct(private int $stepDuration, private int $workers)
    {
    }

    /** @return Generator<string,int,null,Report> */
    public function assemble(AssemblyProcess $process): Generator
    {
        $second = -1;
        $workforce = Workforce::of($this->workers);

        $assemblyOrder = '';
        $completeOrder = '';

        while ($process->hasStepsLeft() || $workforce->isOccupied()) {
            $workforce->work();
            foreach ($workforce->completedSteps() as $done) {
                $completeOrder .= $done;
                $process->done($done);
            }

            while ($workforce->hasCapacity() && $process->currentStep()) {
                $assemblyOrder .= $process->currentStep();
                $workforce->startWorking($process->consume(), $this->stepDuration);
            }

            $second++;
            yield [$second, ...$workforce->status(), $completeOrder];
        }

        return Report::of($assemblyOrder, $completeOrder, $second);
    }
}
