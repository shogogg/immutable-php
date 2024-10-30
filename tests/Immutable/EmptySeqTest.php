<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License!
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\EmptySeq;

describe('::instance', function (): void {
    it('should return an EmptySeq instance', function (): void {
        $actual = EmptySeq::instance();
        expect($actual)->toBeInstanceOf(EmptySeq::class);
    });
});

describe('::of', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => EmptySeq::of(1, 2, 3))->toThrow(BadMethodCallException::class);
    });
});

describe('::from', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => EmptySeq::from([1, 2, 3]))->toThrow(BadMethodCallException::class);
    });
});

describe('->contains', function (): void {
    it('should return false', function (): void {
        $actual = EmptySeq::instance()->contains(2);
        expect($actual)->toBeFalse();
    });
});

describe('->count', function (): void {
    it('should return 0', function (): void {
        $actual = EmptySeq::instance()->count();
        expect($actual)->toBe(0);
    });
});

describe('->countBy', function (): void {
    it('should return 0', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->countBy(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBe(0);
    });
});

describe('->distinct', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->distinct();
        expect($actual)->toBeEmptySeq();
    });
});

describe('->distinctBy', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->distinctBy(fn (int $x): int => $x % 2);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->drop', function (): void {
    it('should return an empty sequence', function (int $n): void {
        $actual = EmptySeq::instance()->drop($n);
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
    it('should return an empty sequence', function (int $n): void {
        $actual = EmptySeq::instance()->dropRight($n);
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
    it('should return an empty sequence', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->dropWhile(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->each', function (): void {
    it('should not call the callback', function (): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        EmptySeq::instance()->each($f);

        // Assert
        $spy->shouldNotHaveReceived('__invoke');
    });
});

describe('->exists', function (): void {
    it('should return false', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->exists(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeFalse();
    });
});

describe('->filter', function (): void {
    it('should return an empty sequence', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->filter(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->filterNot', function (): void {
    it('should return an empty sequence', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->filterNot(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->find', function (): void {
    it('should return a None instance', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->find(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeNone();
    });
});

describe('->flatMap', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->flatMap(fn (int $x): iterable => [$x, $x + 1]);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->flatten', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->flatten();
        expect($actual)->toBeEmptySeq();
    });
});

describe('->fold', function (): void {
    it('should return the initial value', function (): void {
        $actual = EmptySeq::instance()->fold('foo', fn (string $z, string $x): string => "$z $x");
        expect($actual)->toBe('foo');
    });
});

describe('->foldLeft', function (): void {
    it('should return the initial value', function (): void {
        $actual = EmptySeq::instance()->foldLeft('foo', fn (string $z, string $x): string => "$z $x");
        expect($actual)->toBe('foo');
    });
});

describe('->foldRight', function (): void {
    it('should return the initial value', function (): void {
        $actual = EmptySeq::instance()->foldRight('qux', fn (string $x, string $z): string => "$x $z");
        expect($actual)->toBe('qux');
    });
});

describe('->forAll', function (): void {
    it('should return true', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->forAll(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeTrue();
    });
});

describe('->getIterator', function (): void {
    it('should return an EmptyIterator instance', function (): void {
        $actual = EmptySeq::instance()->getIterator();
        expect($actual)->toBeInstanceOf(EmptyIterator::class);
    });
});

describe('->head', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->head())->toThrow(LogicException::class);
    });
});

describe('->headOption', function (): void {
    it('should return a None instance', function (): void {
        $actual = EmptySeq::instance()->headOption();
        expect($actual)->toBeNone();
    });
});

describe('->indexOf', function (): void {
    it('should return -1', function (): void {
        $actual = EmptySeq::instance()->indexOf(2);
        expect($actual)->toBe(-1);
    });
});

describe('->indexWhere', function (): void {
    it('should return -1', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->indexWhere(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBe(-1);
    });
});

describe('->init', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->init())->toThrow(LogicException::class);
    });
});

describe('->isEmpty', function (): void {
    it('should return true', function (): void {
        $actual = EmptySeq::instance()->isEmpty();
        expect($actual)->toBeTrue();
    });
});

describe('->last', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->last())->toThrow(LogicException::class);
    });
});

describe('->lastIndexOf', function (): void {
    it('should return -1', function (): void {
        $actual = EmptySeq::instance()->lastIndexOf(2);
        expect($actual)->toBe(-1);
    });
});

describe('->lastIndexWhere', function (): void {
    it('should return -1', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->lastIndexWhere(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBe(-1);
    });
});

describe('->lastOption', function (): void {
    it('should return a None instance', function (): void {
        $actual = EmptySeq::instance()->lastOption();
        expect($actual)->toBeNone();
    });
});

describe('->map', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->map(fn (int $x): int => $x * 2);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->max', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->max())->toThrow(LogicException::class);
    });
});

describe('->maxBy', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->maxBy(fn (int $x): int => $x))->toThrow(LogicException::class);
    });
});

describe('->min', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->min())->toThrow(LogicException::class);
    });
});

describe('->minBy', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->minBy(fn (int $x): int => $x))->toThrow(LogicException::class);
    });
});

describe('->mkString', function (): void {
    it('should return an empty string', function (): void {
        $actual = EmptySeq::instance()->mkString();
        expect($actual)->toBe('');
    });
});

describe('->nonEmpty', function (): void {
    it('should return false', function (): void {
        $actual = EmptySeq::instance()->nonEmpty();
        expect($actual)->toBeFalse();
    });
});

describe('->offsetExists', function (): void {
    it('should return false', function (): void {
        $actual = EmptySeq::instance()->offsetExists(0);
        expect($actual)->toBeFalse();
    });
});

describe('->offsetGet', function (): void {
    it('should throw an OutOfBoundsException', function (): void {
        expect(fn () => EmptySeq::instance()->offsetGet(0))->toThrow(OutOfBoundsException::class);
    });
});

describe('->offsetSet', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => EmptySeq::instance()->offsetSet(0, 2))->toThrow(BadMethodCallException::class);
    });
});

describe('->offsetUnset', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => EmptySeq::instance()->offsetUnset(0))->toThrow(BadMethodCallException::class);
    });
});

describe('->reverse', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->reverse();
        expect($actual)->toBeEmptySeq();
    });
});

describe('->size', function (): void {
    it('should return 0', function (): void {
        $actual = EmptySeq::instance()->size();
        expect($actual)->toBe(0);
    });
});

describe('->sum', function (): void {
    it('should return 0', function (): void {
        $actual = EmptySeq::instance()->sum();
        expect($actual)->toBe(0);
    });
});

describe('->tail', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => EmptySeq::instance()->tail())->toThrow(LogicException::class);
    });
});

describe('->take', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->take(2);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->takeRight', function (): void {
    it('should return an empty sequence', function (): void {
        $actual = EmptySeq::instance()->takeRight(2);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->takeWhile', function (): void {
    it('should return an empty sequence', function (): void {
        // @phpstan-ignore identical.alwaysFalse
        $actual = EmptySeq::instance()->takeWhile(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeEmptySeq();
    });
});

describe('->toArray', function (): void {
    it('should return an empty array', function (): void {
        $actual = EmptySeq::instance()->toArray();
        expect($actual)->toBeArray()->toBeEmpty();
    });
});

describe('->toSeq', function (): void {
    it('should return itself', function (): void {
        $seq = EmptySeq::instance();
        $actual = $seq->toSeq();
        expect($actual)->toBe($seq);
    });
});
