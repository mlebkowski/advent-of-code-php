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