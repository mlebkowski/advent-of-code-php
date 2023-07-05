# Hex Ed

There are multiple ways to arrive at the same destination. For example:

```
n + s = 0       ne + nw = n
   _ _             _ _ 
 /     \         /     \         
/  ^    \       /  ^  ^ \ _ _    
\  | |  /       \  |   \/     \  
 \ _ _ /         \ _ _ /\      \ 
 / | | \         / |   \/      / 
/    v  \       /      /\ _ _ /  
\       /       \     / /        
 \ _ _ /         \ _ _ /                 
```            

Opposites cancel each other out, and if we take two steps separated by 120°,
we could instead take one step in the direction that is „in between” them.
Following those optimizations, we arrive at a normalized path that cannot be
reduced further (in terms of the number of steps).
