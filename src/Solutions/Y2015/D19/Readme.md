# Folding the Reindeer Medicine

After the brute-force solution didn’t yield any interesting results after 100MM iterations,
I sent out to find a smarter approach. Most solutions I found was either brute forcing
(maybe they had faster machines, maybe their procedural code was way more efficient, or
maybe they just found the solution by pure luck), but there was also this gem:

https://www.reddit.com/r/adventofcode/comments/3xflz8/day_19_solutions/cy4etju/

TL;DR; askalski discovered, that there are two kind of transformations:

* `e` (protomolecule) or `X` (element) into `XX` (compound, two elements joined)
* or `X` into `X Rn X Ar` and such

Let’s replace `Rn` with `(`, `Y` with `,` and `Ar` with `)` to get those transformations

* `X → A(B) | A(B,C) | A(B,C,D)`

This means, that whenever there is a `X(TTT,RRR,SSS)` pattern, you need to first fold
the inner parts into `X(T,R,S)`. That is good, this means the problem can be broken into
smaller parts.

Now instead of bruteforcing I created a molecule parser. It would recognize Elements (`Al`) and
Compounds (`CaSi`) and Complex structures (`C(F,Mg)`). I was hoping that I could fold from
the innermost parenthesis up, and the order would not matter. I also applied some optimizations,
to try and match the longest compounds first (hoping that it would result in fewer required steps).

Unfortunately, I started running into problems, where I was left with molecule parts that could
not be folded. I tried to shuffle the folding order, and I pushed it one step forward at a time,
but I could not get a general rule — except for trying all the variations. I was worried that this
was turning back into the brute force solution again.

So back to the drawing board.

## Chemistry

So I tried to look at the chemistry rules. Different elements and transformations.
Here what I came up with:

```
1st generation  2nd generation    3rd generation
e → HF          H → C(Al)         Ca → CaCa
e → NAl         H → C(F,F,F)      Ca → PB
e → OMg         H → C(F,Mg)       Ca → P(F)
                H → C(Mg,F)       Ca → Si(F,F)
                H → HCa           Ca → Si(Mg)
                H → N(F,F)        Ca → SiTh
                H → N(Mg)
                H → NTh           Th → ThCa
                H → OB
                H → O(F)          B → BCa
                                  B → TiB
                F → CaF           B → Ti(F)
                F → PMg
                F → SiAl          P → CaP
                                  P → PTi
                N → C(F)          P → Si(F)
                N → HSi
                                  Si → CaSi
                Al → ThF
                Al → Th(F)        Ti → BP
                                  Ti → TiTi
                O → C(F,F)
                O → C(Mg)
                O → HP
                O → N(F)
                O → OTi

                Mg → BF
                Mg → TiMg
```

There are different „generations” of elements. First, there is only the protomolecule.
In my input, it could produce 3 compounds, 6 elements each. And those 6 elements, through
various transformations, could produce next 6 elements and multiple complex structures.
I have not yet noticed anything about the 3rd gen elements, but it will become apparent soon.

### Closer look at the complex structures

The 2nd generation elements can produce first complex elements (in the form `X(A,…)`).
So I grouped all of them together to get:

* `C(Al)`, `C(F)`, `C(F,F)`, `C(F,F,F)`, `C(Mg)`, `C(F,Mg)`, `C(Mg,F)`, `N(F,F)`, `N(Mg)`, `N(F)`, `O(F)`, `Th(F)`,

Peculiar, they all contain only one of three elements as their „contents”: `F`, `Al` or `Mg`.
This means, that solving inner molecules (contained within *any* parenthesis) can be limited
to elements and that can be produced from those three elements alone. Let’s have a look:

```
1nd generation    2nd generation
F → CaF           Ca → CaCa
F → PMg           Ca → PB
F → SiAl          Ca → P(F)
                  Ca → Si(F,F)
Al → ThF          Ca → Si(Mg)
Al → Th(F)        Ca → SiTh
             
Mg → BF           Th → ThCa
Mg → TiMg
                  B → BCa
                  B → TiB
                  B → Ti(F)

                  P → CaP
                  P → PTi
                  P → Si(F)

                  Si → CaSi

                  Ti → BP
                  Ti → TiTi
```

The last column hasn’t changed a bit: you can still produce all of those 6 elements, even
if the source is limited to 3 elements only in the previous generation. But the complex
structures are limited once more to:

* `Th(F)`, `P(F)`, `Si(F,F)`, `Si(Mg)`, `Ti(F)`, `Si(F)`

And there are only two inner elements, so we *could* build the next derivative,
without `Al` element. Unfortunately, since there is `F → SiAl` transformation,
that element is not entirely eradicated from the chemistry set, so I do not think
that any more optimizations can be done on this front. But since about 60-70% of
my input molecule is inside parenthesis. that seems like a huge win already.

Next step is to apply this logic to parsing and I’m hoping, that this will allow
me to unambiguously fold inner parts. Either way, I’m off to coding that logic,
and let’s see where it gets us.
