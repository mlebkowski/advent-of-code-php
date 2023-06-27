<?php
declare(strict_types=1);

namespace App\Solutions\Y2016\D10;

use Generator;
use loophp\collection\Collection;

final class MicrochipFactory
{
    private array $output = [];

    public static function ofInitialDisposition(array $rules, array $dispositions): self
    {
        $bots = Collection::fromIterable($dispositions)
            ->groupBy(static fn (InitialDisposition $disposition) => $disposition->botId)
            ->map(static fn (iterable $dispositions, int $botId) => Robot::of(
                $botId,
                Collection::fromIterable($dispositions)
                    ->map(static fn (InitialDisposition $disposition) => $disposition->value)
                    ->all(),
            ))
            ->all(false);

        $rules = Collection::fromIterable($rules)
            ->map(static fn (Rule $rule) => [$rule->botId, $rule])
            ->unpack()
            ->all(false);

        return new self($bots, $rules);
    }

    private function __construct(
        /** @var Robot[] */
        private array $bots,
        /** @var Rule[] */
        private readonly array $rules,
    ) {
    }

    public function run(): Generator
    {
        do {
            yield from $transfers = Collection::fromIterable($this->bots)
                ->filter(static fn (Robot $robot) => $robot->isFull())
                ->map(static fn (Robot $robot) => $robot->transfer())
                ->apply($this->executeTransfer(...))
                ->squash();
        } while ($transfers->isNotEmpty());
    }

    private function executeTransfer(TransferOut $transferOut): true
    {
        $rule = $this->rules[$transferOut->botId];
        assert($rule);
        $this->move($transferOut->low, $rule->low);
        $this->move($transferOut->high, $rule->high);

        return true;
    }

    private function move(int $value, Target $target): void
    {
        if ($target->isOutput()) {
            $this->output[$target->value] = $value;
        } else {
            $bot = $this->bots[$target->value] ?? $this->bots[$target->value] = Robot::empty($target->value);
            $bot->take($value);
        }
    }
}
