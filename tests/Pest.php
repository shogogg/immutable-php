<?php

declare(strict_types=1);

use Immutable\EmptySeq;
use Immutable\None;
use Immutable\Seq;
use Immutable\Some;
use Mockery\MockInterface;
use Pest\Expectation;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "pest()" function to bind a different classes or traits.
|
*/

// pest()->extend(Tests\TestCase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeEmptySeq', function (): Expectation {
    // @phpstan-ignore variable.undefined
    return $this->toBeInstanceOf(EmptySeq::class);
});

expect()->extend('toBeNone', function (): Expectation {
    // @phpstan-ignore variable.undefined
    return $this->toBeInstanceOf(None::class);
});

expect()->extend('toBeSeq', function (mixed ...$value): Expectation {
    // @phpstan-ignore variable.undefined
    return $this->toEqual(Seq::of(...$value));
});

expect()->extend('toBeSome', function (mixed $value): Expectation {
    // @phpstan-ignore variable.undefined
    return $this->toEqual(Some::of($value));
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function spyFunction(MockInterface $spy): \Closure
{
    return function () use ($spy): void {
        // @phpstan-ignore argument.type
        call_user_func_array($spy, func_get_args());
    };
}
