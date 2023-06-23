## Combinations strike again

https://adventofcode.com/2015/day/24

There are two significant optimizations here. The first one is rather minor,
and I caught quite quick. The second one makes a real difference.

Calculating the combinations of presents that can go into the passenger
compartment can be viewed as a tree. Most of the paths on that tree lead
to a set that does not divide the present weights equally. It seems wasteful
to continue on that path if we already know that the sum exceeds the weight
we expect. That was the first optimization, but it still left me with
over 200k iterations (of valid sets!). They took over 3 minutes to calculate.

The second breakthrough came when I realized that there is a second constraint:
we need to only consider the smallest sets. So as soon as we get any solution
(with a correct summary weight), we can skip calculating sets with size greater
than the best we saw so far.

Unfortunately, after implementing that part it barely made a difference. I was
unsure if I implemented it correctly, and after a couple of minutes of step
debugging it hit me: with that ordering of weights (ascending), we start
discovering the largest sets first! I even had a test for that (with a smaller
list), that clearly shown that the set sizes decreased over time.

I first tried with `rsorting` the input list, and realized I had a bug in the
implementation. In the end, I ended up with providing ascending weight list,
but changing the algo order. The results: I got my solution in 300 iterations!
Three orders of magnitude improvement!

It does not *completely* limit the results to the smallest sets only, so minor
cleanups are required, but at least I don’t need to operate on 200k items.