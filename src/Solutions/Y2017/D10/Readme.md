# Knot Hash

Rotating the list instead of keeping the current index mad it far easier, especially
since the length could never extend beyond the list length. I think that was the goal
of this challenge in the first place. I made two mistakes, though:

* I rotated the length and skip count at once, which made me run out of bounds for
  large lengths, and produced invalid results (effectively skip count was trimmed)
* And since I need to get the head of the list at the end, I needed to rotate it back,
  but I rotated it forward mistakenly :joy:

What’s more interesting, for the sample input those two errors seemed to cancel each
other out, because I did get the correct result. Anyway: easy as pie.

## Part II

I just forgot to modulo the `skipCount`. With that many iterations it very soon overflown
past the list length. Fixing that magically made all tests turn green. I was a little worried
there, because there is no real way to debug what kind of hash this process produces.
Oh, and I forgot to pad hex values with leading zeros at first, but that was an easy spot,
since the hashes were too short.