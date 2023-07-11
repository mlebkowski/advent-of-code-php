# Frequencies

I tried to be smart, I tried to be memory efficient. I wanted to detect a loop.
Then I realized that the loop might not be within the sequence itself, but rather
in the looped sequence, so there was no upper limit to the loop detection iterations.

In fact, the loop length was `146 091`. My memory efficient algo would never arrive
at that solution.