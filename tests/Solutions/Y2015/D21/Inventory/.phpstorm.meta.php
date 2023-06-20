<?php

declare(strict_types=1);

namespace PHPSTORM_META;

registerArgumentsSet(
    'itemNames',
    'Dagger',
    'Shortsword',
    'Warhammer',
    'Longsword',
    'Greataxe',
    'Leather',
    'Chainmail',
    'Splintmail',
    'Bandedmail',
    'Platemail',
    'Damage +1',
    'Damage +2',
    'Damage +3',
    'Defense +1',
    'Defense +2',
    'Defense +3',
);

expectedArguments(\App\Realms\RolePlaying\Inventory\ItemShop::get(), 0, argumentsSet('itemNames'));
expectedArguments(\App\Realms\RolePlaying\CharacterMother::withItems(), 1, argumentsSet('itemNames'));
expectedArguments(\App\Realms\RolePlaying\CharacterMother::withItems(), 2, argumentsSet('itemNames'));
expectedArguments(\App\Realms\RolePlaying\CharacterMother::withItems(), 3, argumentsSet('itemNames'));
expectedArguments(\App\Realms\RolePlaying\CharacterMother::withItems(), 4, argumentsSet('itemNames'));
