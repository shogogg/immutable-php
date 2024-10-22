<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\None;

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
        $actual = None::instance()->countBy(fn (int $x): bool => $x > 0);
        expect($actual)->toBe(0);
    });
});

describe('->drop', function (): void {
    it('should return an empty Seq even if any number is passed', function (int $n): void {
        $actual = None::instance()->drop($n);
        expect($actual)->toBeEmptySeq();
    })->with([
        [-2],
        [-1],
        [0],
        [1],
        [2],
    ]);
});

describe('->dropRight', function (): void {
    it('should return an empty Seq even if any number is passed', function (int $n): void {
        $actual = None::instance()->dropRight($n);
        expect($actual)->toBeEmptySeq();
    })->with([
        [-2],
        [-1],
        [0],
        [1],
        [2],
    ]);
});

describe('->dropWhile', function (): void {
    it('should return an empty Seq even if any predicate is given', function (\Closure $p): void {
        $actual = None::instance()->dropWhile($p);
        expect($actual)->toBeEmptySeq();
    })->with([
        [fn (int $x): bool => $x > 0],
        [fn (int $x): bool => $x === 0],
        [fn (int $x): bool => $x < 0],
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
        $actual = None::instance()->exists(fn (int $x): bool => $x > 0);
        expect($actual)->toBeFalse();
    });
});

describe('->filter', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->filter(fn (int $x): bool => $x > 0);
        expect($actual)->toBeNone();
    });
});

describe('->filterNot', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->filterNot(fn (int $x): bool => $x > 0);
        expect($actual)->toBeNone();
    });
});

describe('->find', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->find(fn (int $x): bool => $x > 0);
        expect($actual)->toBeNone();
    });
});

describe('->flatMap', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->flatMap(fn (int $x): None => None::instance());
        expect($actual)->toBeNone();
    });
});

describe('->flatten', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->flatten();
        expect($actual)->toBeNone();
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
        [fn (int $x): bool => $x > 0],
        [fn (int $x): bool => $x === 0],
        [fn (int $x): bool => $x < 0],
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
        expect($actual)->toBeNone();
    });
});

describe('->isEmpty', function (): void {
    it('should return true', function (): void {
        $actual = None::instance()->isEmpty();
        expect($actual)->toBeTrue();
    });
});

describe('->last', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->last())->toThrow(LogicException::class);
    });
});

describe('->lastOption', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->lastOption();
        expect($actual)->toBeNone();
    });
});

describe('->map', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::instance()->map(fn (int $x): int => $x * 2);
        expect($actual)->toBeNone();
    });
});

describe('->max', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->max())->toThrow(LogicException::class);
    });
});

describe('->maxBy', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->maxBy(fn (string $x): int => strlen($x)))->toThrow(LogicException::class);
    });
});

describe('->min', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->min())->toThrow(LogicException::class);
    });
});

describe('->minBy', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::instance()->minBy(fn (string $x): int => strlen($x)))->toThrow(LogicException::class);
    });
});

describe('->mkString', function (): void {
    it('should return an empty string', function (): void {
        $actual = None::instance()->mkString();
        expect($actual)->toBe('');
    })->with([
        [''],
        [','],
        [' '],
    ]);
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

describe('->take', function (): void {
    it('should return an empty Seq even if any number is passed', function (int $n): void {
        $actual = None::instance()->take($n);
        expect($actual)->toBeEmptySeq();
    })->with([
        [-2],
        [-1],
        [0],
        [1],
        [2],
    ]);
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
        expect($actual)->toBeEmptySeq();
    });
});
