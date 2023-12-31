# Cartography module was used

```
@...................................╷G
....................................│.
.................................┌──┘.
.................................│....
.................................│....
.................................│....
................................┌┘....
................................│.....
...............................┌┘.....
...............................│......
.............................┌─┘......
.............................│........
.............................│........
.................┌───────────┘........
.................│....................
.................│....................
.................│....................
.................│....................
.................│....................
..............┌──┘....................
..........┌───┘.......................
.........┌┘...........................
........┌┘............................
........│.............................
........│#############################
........└─────────────────────────┐...
..................................╵...
......................................
```

Okay, the tools are there, and the solution is simple. Especially once I plotted the map.

The first thing I’ve done is to display a map of the grid, highligting my access node, the
target data node, the „larger and very full” nodes and the empty one as well. As it turns
out, the „full nodes” are building a „wall” between the data node and the empty node. No
problem, we will go around it.

The `PathFinding` module is already build for it: I marked the full nodes as blocked, and all
other as available. Then I asked it to find a path between the empty node, and a node to the
west (left) of the data node. Have you noticed, that moving data around is basically the same
as moving the empty node in the opposite direction?

Once I’m there (that is: the empty node is there), there is one more transfer to swap the
valuable data one block closer to me. From that point, I need to „go around” the node containing
target data with the empty node (it takes 5 steps to do that), to move the my prize one step to
the left.

```
0.      1.      2.      3.      4.      5.

..G_.   ..G..   ..G..   ..G..   ._G..   .G_..
.....   ..._.   .._..   ._...   .....   .....
```

Repeating that process 26 times (the width of the grid is 28) gives me access to the data.