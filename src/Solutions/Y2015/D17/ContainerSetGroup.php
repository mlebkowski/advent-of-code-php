<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D17;

interface ContainerSetGroup
{
    public function count(): int;

    public function apply(ContainerSet $set): ContainerSetGroup;
}
