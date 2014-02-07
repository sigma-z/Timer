# SigmaZ\Timer

It's a lightweight timer, useful for debugging and timing.

## Requires
 * PHP 5.3 or greater

[On GitHub]: https://github.com/sigma-z/Timer


## Usage

### Basic timing

```php
use SigmaZ\Timer;

Timer::start();
$timeElapsed = Timer::stop();
```

### Cumulative timings

```php
use SigmaZ\Timer;

for ($i = 0; $i < 1000; $i++) {
    funcOne();
}

for ($i = 0; $i < 1000; $i++) {
    funcTwo();
}

foreach (Timer::getElapsedTimes as $name => $elapsedTime) {
    echo "$name: $elapsedTime\n";
}

function funcOne()
{
    Timer::start(__METHOD__);
    // .. code in here ..
    Timer::stop(__METHOD__);
}

function funcTwo()
{
    Timer::start(__METHOD__);
    // .. code in here ..
    Timer::stop(__METHOD__);
}
```

The output will be:

    funcOne: 0.0065863132476807
    funcTwo: 0.006711483001709
