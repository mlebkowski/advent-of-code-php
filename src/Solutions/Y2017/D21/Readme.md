# Optimization

I used reddit to help me. Basically, each 3×3 will become 9×9 after 3 iterations:

* 3×3 is one tile, becoming 4×4
* 4×4 splits into four 2×2 tiles, becoming four 3×3 = 6×6
* 6×6 splits into nine 2×2 tiles, becoming nine 3×3 = 9×9

And from there, the process repeats: each of the 9 3×3’s expand further. This means,
that 18 iterations can be represented as 6×3 iterations, each operating on a 3×3 tile only.
Each iteration nontuples (multiples by 9) the number of existing tiles, resulting in
`9^6 = 531441` tiles at the end.

The algorithm calculates and caches the `3×3 → 9×9` transformations. Then, in each step,
it multiplies each tile using this precomputed map. As it later turned out, there are
only 6 of them used in the entire process, so that’s quite an optimization.
