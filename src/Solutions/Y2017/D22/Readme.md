# Next example of how useful the Cartography Realm is

I did manage to get an off-by-one error either way. Somehow I counted the iterations wrong.

But either way, the implementation of this challenge consists of:

* Parsing a Map from string — using an existing `fromString` method
* Evaluating a center point of that map using arithmetic (yep, off-by-one, I used `ceil` instead of `floor` there too)
* Feeding that map as an initial state to the cluster
* And then there’s the virus carrier `burst()` method, which basically uses a bunch of `match` statements

The Virus Carrier implementation is a higher level abstraction over `Cartography`. It uses
`directions`, `turns`, it moves, etc. All that stuff was already there. The most complex thing
was to implement two separate strategies (using flagging/weakining or not), but I opted for
a single boolean flag to keep things simple.