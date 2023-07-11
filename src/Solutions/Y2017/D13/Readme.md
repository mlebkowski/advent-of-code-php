# Scanners

Those challenges are becoming more and more about the visualization. :)

https://github.com/mlebkowski/advent-of-code-php/raw/main/src/Solutions/Y2017/D13/assets/scanners.mov

But along the way I figured out the smart solution. I like smart solutions.
So the scanner oscilates. Goes up and down, and arrives at its starting position,
and then loops. How much steps does it take it to do one loop? Well, it starts
at range=1, moves through all intermediate ranges, arrives at range=max, and goes
back — through all the intermediate ranges again:

```
1 . 
2 | |
3 | |
4 | |
5 | |
6   '
```

So given range 6 for example, each cycle it visits 4 middle items twice, then each edge
once, which gives 2 × 5 steps. Each scanner uses `(range - 1) × 2` steps for each cycle.

Now, since we only really care about when they arrive at positions 0, through which we
travel, we need to know which cycles complete (i.e. the scanner moves back to first position)
at the time we arrive at a given depth. And this translates to: which scanners term divide
their depth without remainder.

## Some learnings from today

* You can disable terminal cursor using ANSI codes, useful for animations
* It’s easier to plot something in columns, and `transpose()` for row-based output
* The second part solution could be faster, but I can’t be bothered by that optimization.
  Some great discussions on reddit, as
  usual: https://www.reddit.com/r/adventofcode/comments/7jgyrt/2017_day_13_solutions/