# Threading

I was trying very hard to keep the current processor arch, and juggle four separate threads:

* Two for processor instructions
* Two for I/O

But they were anchored in different places, so I don’t think it would be possible in the end.
This is why I simlpy propagated the empty buffor (`ReadWait`) as an event and switched threads
then. If after returning to the original thread the retry failed the same way, I recognize
a deadlock and terminate.

I struggled a lot with my initial approach and then realized that I cannot switch between
threads / generators by `send()`ing, but I need to `yield` instead. After I implemented
the yield / switch / continue logic, it just worked at first try, unexpectedly :joy: 