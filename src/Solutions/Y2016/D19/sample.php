<?php declare(strict_types=1);

printf(" n.   n(bin)  remainders   elf  elf(bin)\n");
foreach (range(2, 32) as $i) {
    $remainders = substr(decbin($i), 1);
    $expected = bindec($remainders) << 1;
    printf(
        "% 2d.   % 6s      % 6s    % 2d    % 6s\n",
        $i,
        decbin($i),
        $remainders,
        $expected + 1,
        decbin($expected),
    );
}
