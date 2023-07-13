# Goblins everywhere!

Yeah, I had an off by-one error (I wrongly counted the number of finished rounds).
Besides that, the only real error I made was not realizing that my pathfinding
will not object to returning a path *from a blocked* square.

This is very similar to the [cart challenge](../D13). I copied some code. A lot of
code. But not enough to refactor into its separate realm.

Ok, but what happened here? The `AttackTargetFactory` is very simple, it’s basically
a glorified sorter. The next step OTOH, boy, that’s a monster. If I had my own
pathfinding implementation I could make it focus on specific routes, given two similar
alternatives. But I don’t, so I have to cheat:

* Find separate paths to/from adjacent fields, and choose one from many

This makes the whole „game” quite slow, but I had delays inserted between turns
either way… I could just remove them ;) You can see the animation speed up a bit
once all the enemies find their targets (there is a short circuit when a unit
has an enemy in range, and no path finding is even initialized).

![](assets/goblins.gif)

The `Combat::animate()` itself is much simpler this time. It still contains the logic
required to run the game itself — that could be probably be extracted to a generator,
but since I’ve got my answer on a second try, I didn’t need to unit test it.

I like to extract pieces of logic/decisions, like `ReadingOrder`, etc. It didn’t make
much sense here, but I think that is a good practice in general: to avoid anonymous
closures.

Speaking of that, let me get back to the `NextStepFactory`. It actually does a number
of witty transformations, and I had to debug them :-/ Fortunately, it turned out
to be quite easy:

* add a „tap” operation `->apply(fn ($whatever) => true)` and set a breakpoint there

The added benefit is that the evaluation is different, since collections use generators.
You follow the „first item” through all the transformations. So instead of:

* Inspect all adjacent points
* Inspect path finding for each point

You get:

* Inspect first adjacent point
* Inspect its path to target
* Repeat for next point…