# An Elephant Named Joseph

https://adventofcode.com/2016/day/19

Ok, so I immediately noticed that it is about continuous division by two. I had a hunch,
that if I continuously divide by two, and store if the result was odd or even, I could
use that to calculate the result. But I couldn’t figure out the rule from the get go.

So I visualized it:

```
 n.   n(bin)  remainders   elf  elf(bin)
 2.       10           0     1         0
 3.       11           1     3        10
 4.      100          00     1         0
 5.      101          01     3        10
 6.      110          10     5       100
 7.      111          11     7       110
 8.     1000         000     1         0
 9.     1001         001     3        10
10.     1010         010     5       100
11.     1011         011     7       110
12.     1100         100     9      1000
13.     1101         101    11      1010
14.     1110         110    13      1100
15.     1111         111    15      1110
16.    10000        0000     1         0
17.    10001        0001     3        10
18.    10010        0010     5       100
19.    10011        0011     7       110
20.    10100        0100     9      1000
21.    10101        0101    11      1010
22.    10110        0110    13      1100
23.    10111        0111    15      1110
24.    11000        1000    17     10000
25.    11001        1001    19     10010
26.    11010        1010    21     10100
27.    11011        1011    23     10110
28.    11100        1100    25     11000
29.    11101        1101    27     11010
30.    11110        1110    29     11100
31.    11111        1111    31     11110
32.   100000       00000     1         0
```

At first, I recorded the divisions in reverse order and I had a hard time figuring them out.
But once I reversed them it became obvious, that their binary representation was the same
as the number of elves without its most significant bit. The sample script had a more crude
way of doing that :joy:

https://stackoverflow.com/questions/7790233/how-to-clear-the-most-significant-bit

Then, the result. I computed them by hand for the first 31 integers, and they also
followed a pattern. `1`, `1 3`, `1 3 5 7`... Yeah, but let’s look at the binary representation!
It’s clear that it is the division column right-shifted by one bit! Actually, here is
where the off-by-one comes in, since the elves are numbered from 1.

The resulting elf *index* is `eraseMostSignificantBit($numberOfElves) << 1`, and I need to
add one to that value to get the *elf name/number*.