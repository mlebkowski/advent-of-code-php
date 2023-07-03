# Let’s look for patterns

The spiral in the description was convinently cut short. Let’s continue drawing
it for just a few more numbers to see what patterns emerge.

```
37 _36_ 35  34  33  32  31
38  17 _16_ 15  14  13  30
39  18   5  _4_  3  12  29
40  19   6  (1) _2_ 11  28
41  20   7   8  (9) 10  27
42  21  22  23  24 (25) 26
43  44  45  46  47  48 (49) 
```

Yep, the bottom-right corner of each „layer” is a perfect square. Curiously, squares
of even numbers also form an arc. I must’ve saw some kind of 3blue1brown video about it.

So that will be the starting point. Find the lowest perfect square, greater or equal than
the number in question, let’s name its root `n`. From there, we oscilate
between `(n-1)/2` and `n-1` steps to the center. Just for fun, let’s plot the spiral of
distances:

```
    █ ▓ █        6 5 4 3 4 5 6 
  █ ▓ ▒ ▓ █      5 4 3 2 3 4 5 
█ ▓ ▒ ░ ▒ ▓ █    4 3 2 1 2 3 4 
▓ ▒ ░   ░ ▒ ▓    3 2 1 0 1 2 3 
█ ▓ ▒ ░ ▒ ▓ █    4 3 2 1 2 3 4 
  █ ▓ ▒ ▓ █      5 4 3 2 3 4 5 
    █ ▓ █        6 5 4 3 4 5 6  
```

Ok, so the solution is to calculate the distance to the nearest edge center, which might
be a negative number. This way when applying `abs()` we will get the desired v-shaped
line. And then, add the ring number — because that is the distance in straight line from
the edge center to the spiral center.

## Part II

For the second part I decided to use the „brute-force” approach, or rather more precisely,
to create the spiral builder itself. It has two responsibilities: to lay out values in
spiral (doh!) and to calculate those values based on… Things. This is why `ValueFactory`
is extracted. Same spiral builder can either create a chain of sequential integers, or
calculate the values based on current point neighbours.