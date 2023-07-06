# Part I

To operate easily in the problem space, I created a data structure that holds 1-n pipe
connections, indexed by both ends. The input was kind enough to list each pipe twice,
from each direction, so it made things that much simpler.

The solution to explore a group given a member is to keep a track of the group so far,
find all the connections the member has, add them to the group (avoid duplicates!),
find all the connections they have (uniquely!), sans the members we already seen,
and repeat the process until we have no unseen connections.

# Part II

Given the above, to find the number of groups:

* I chose a random member, and discovered its group
* Since group members cannot overlap (by definition), I then remove all group members
  from the system, add one to the count and repeat recursively
* I break when there are no members left

No visualization today.