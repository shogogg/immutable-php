<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\None;
use Immutable\Seq;

describe('::instance', function (): void {
    it('should return the None instance', function (): void {
        $actual = None::instance();
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('::of', function (): void {
    it('should return a None instance', function (mixed $value): void {
        $actual = None::of($value);
        expect($actual)->toBeInstanceOf(None::class);
    })->with([
        [0],
        [0.0],
        [17],
        ['foo'],
        [[]],
        [new stdClass()],
        [null],
    ]);
});

describe('->count', function (): void {
    it('should return 0', function (): void {
        $actual = None::instance()->count();
        expect($actual)->toBe(0);
    });
});

describe('->countBy', function (): void {
    it('should return 0', function (): void {
        $actual = None::instance()->countBy(fn (int $value): bool => $value > 0);
        expect($actual)->toBe(0);
    });
});

describe('->drop', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = None::instance()->drop(0);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return an empty Seq even if any number is passed', function (int $n): void {
        $actual = None::instance()->drop($n);
        expect($actual)->toBeEmpty();
    })->with([
        [-2],
        [-1],
        [0],
        [1],
        [2],
    ]);
});

describe('->each', function (): void {
    it('should not call the callback', function (): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        None::instance()->each($f);

        // Assert
        $spy->shouldNotHaveReceived('__invoke');
    });
});

describe('->exists', function (): void {
    it('should return false', function (): void {
        $actual = None::instance()->exists(fn (int $value): bool => $value > 0);
        expect($actual)->toBeFalse();
    });
});

describe('->filter', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->filter(fn (int $value): bool => $value > 0);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->filterNot', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->filterNot(fn (int $value): bool => $value > 0);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->find', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->find(fn (int $value): bool => $value > 0);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->flatMap', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->flatMap(fn (int $value): None => None::instance());
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->flatten', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->flatten();
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->fold', function (): void {
    it('should return the initial value', function (): void {
        $actual = None::instance()->fold(17, fn (int $z, int $x): int => $z + $x);
        expect($actual)->toBe(17);
    });
});

describe('->forAll', function (): void {
    it('should return true even if any predicate is given', function (\Closure $p): void {
        $actual = None::instance()->forAll($p);
        expect($actual)->toBeTrue();
    })->with([
        [fn (int $value): bool => $value > 0],
        [fn (int $value): bool => $value === 0],
        [fn (int $value): bool => $value < 0],
    ]);
});

describe('->get', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->get())->toThrow(LogicException::class);
    });
});

describe('->getIterator', function (): void {
    it('should return an EmptyIterator', function (): void {
        $actual = None::instance()->getIterator();
        expect($actual)->toBeInstanceOf(EmptyIterator::class);
    });
});

describe('->head', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->head())->toThrow(LogicException::class);
    });
});

describe('->headOption', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->headOption();
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->isEmpty', function (): void {
    it('should return true', function (): void {
        $actual = None::instance()->isEmpty();
        expect($actual)->toBeTrue();
    });
});

describe('->map', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->map(fn (int $value): int => $value * 2);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->nonEmpty', function (): void {
    it('should return false', function (): void {
        $actual = None::instance()->nonEmpty();
        expect($actual)->toBeFalse();
    });
});

describe('->offsetExists', function (): void {
    it('should return false', function (): void {
        $actual = None::instance()->offsetExists(0);
        expect($actual)->toBeFalse();
    })->with([
        [0],
        [1],
        [2],
    ]);
});

describe('->offsetGet', function (): void {
    it('should throw an OutOfBoundsException', function (): void {
        expect(fn () => None::instance()->offsetGet(0))->toThrow(OutOfBoundsException::class);
    });
});

describe('->offsetSet', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => None::instance()->offsetSet(0, 0))->toThrow(BadMethodCallException::class);
    });
});

describe('->offsetUnset', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => None::instance()->offsetSet(0, 0))->toThrow(BadMethodCallException::class);
    });
});

describe('->size', function (): void {
    it('should return 0', function (): void {
        $actual = None::instance()->size();
        expect($actual)->toBe(0);
    });
});

describe('->toArray', function (): void {
    it('should return an array', function (): void {
        $actual = None::instance()->toArray();
        expect($actual)->toBeArray();
    });

    it('should return an empty array', function (): void {
        $actual = None::instance()->toArray();
        expect($actual)->toBeEmpty();
    });
});

describe('->toSeq', function (): void {
    it('should return an empty Seq', function (): void {
        $actual = None::instance()->toSeq();
        expect($actual)->toBeInstanceOf(Seq::class)->toBeEmpty();
    });
});
