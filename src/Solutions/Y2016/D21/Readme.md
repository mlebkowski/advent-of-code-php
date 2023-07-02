# Rotating based on letter

Let’s start with a visualization:

```
  2 (✔):  1  0
  3 (✘):  1  0  0
  4 (✔):  1  3  2  0
  5 (✘):  1  3  0  3  0
  6 (✔):  1  3  5  2  4  0
  7 (✘):  1  3  5  0  3  5  0
  8 (✔):  1  3  5  7  2  4  6  0
  9 (✘):  1  3  5  7  0  3  5  7  0
 10 (✔):  1  3  5  7  9  2  4  6  8  0
 11 (✘):  1  3  5  7  9  0  3  5  7  9  0
 12 (✔):  1  3  5  7  9 11  2  4  6  8 10  0
 13 (✘):  1  3  5  7  9 11  0  3  5  7  9 11  0
 14 (✔):  1  3  5  7  9 11 13  2  4  6  8 10 12  0
 15 (✘):  1  3  5  7  9 11 13  0  3  5  7  9 11 13  0
 16 (✔):  1  3  5  7  9 11 13 15  2  4  6  8 10 12 14  0
```

The operation is only reversible if it maps uniquely from source to target. In any other instance
there would be ambiguity as to what source procuded given target. Let’s go back to the roots
and inspect what’s required for function to be reversible:

https://www.wikiwand.com/en/Inverse%20function

So now, let’s change the harcdoded `plus one additional time if the index was at least 4`
to `plus one additional time if the index was at after the half-point`. This way any input
of even length can be reversed. Unfortunately, no luck for odd-length inputs, as without
any additional rules, the rotation produces duplicates.