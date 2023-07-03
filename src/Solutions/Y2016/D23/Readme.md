# While my brute-force solution is running in the background...

I executed it like 20 minutes ago and it’s currently overheating my CPU.
It’s at 3B operations rn, and every loop seems to be longer, so I think
I can safely optimize the solution before it ends.

```shell
> time ./aoc.php 2016 23 2
year 2016, day 23, part Two
---

Solving challenge
Result: 479010245


________________________________________________________
Executed in   17.95 mins    fish           external
   usr time   17.74 mins   58.00 micros   17.74 mins
   sys time    0.10 mins  781.00 micros    0.10 mins

```

Ok, so actually it managed to finish (while debugging I realized that the exit
condition was different than I thought), but I will still try to optimize, because
that seems like a fun challenge.

I looked at the code to optimize the algorithm itself, but all I found was
increments, decrements, reads, writes… Some `instanceof`, but I doubt that
could be the culprit. So I looked for solutions online:

https://www.reddit.com/r/adventofcode/comments/5jvbzt/2016_day_23_solutions/dbjbish/

Yeah, that seems obvious. The following is a multiplication done by addition
in a loop:

```
cpy b c
inc a
dec c
jnz c -2
dec d
jnz d -5
```

So the first part: I will try to detect this pattern statically to optimize
the first loop. Then, if that is not sufficient, I will do that dynamically at runtime,
after every `tgl`, because this is when the instructions change. The actual code
for the second loop before code runs is:

```
jnz 91 d  # this will be replaced to cpy
inc a
inc d
jnz d -2
inc c
jnz c -5
```

So almost, but no cookie. Let’s code.

## Debugging

I actually added a debugger statement to my assembly! How cool is that?!
I mean, it just wraps an operation in a `Breakpoint` class and then I use my IDE’s
conditional breakpoint feature, but cool nonetheless.

Since I have my inputs cached locally, I can actually modify them, and this is how
I marked breakpoints:

```
15. inc c
15. jnz d -2
17. • tgl c
18. • cpy -16 c
19. • jnz 1 c
20. • cpy 95 c
21. jnz 91 d
22. inc a
```

## Optimization result

The solution is very crude. It literally looks for exact set of instructions and
replaces it with add/multiply instructions. Does it work? Judge for yourself:

```shell
> time ./aoc.php 2016 23 2
year 2016, day 23, part Two
---

Solving challenge
Result: 479010245


________________________________________________________
Executed in  131.27 millis    fish           external
   usr time   46.31 millis    0.07 millis   46.24 millis
   sys time   36.03 millis    1.74 millis   34.29 millis
```