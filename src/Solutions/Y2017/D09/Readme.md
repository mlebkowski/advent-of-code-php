# Writing a parser

Today I learned the basics of how to write a parser:

* https://lisperator.net/pltut/parser/input-stream
* https://lisperator.net/pltut/parser/token-stream
* https://lisperator.net/pltut/parser/the-ast
* https://lisperator.net/pltut/parser/the-parser

I don’t yet get all the patterns and the code seems a bit clunky. The error reporting is all
over the place, too. But the test cases pass :joy:

## Emitting the garbage separately

I got this idea from here:

* https://supunsetunga.medium.com/writing-a-parser-getting-started-44ba70bb6cc9

Somehow I like the concept that the parser only returns groups, and they are not tainted
with garbage. If I want to know about the garbage, I need to provide a separate observer
during the parsing process.