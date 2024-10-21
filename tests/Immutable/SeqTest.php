<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License!
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\Seq;

describe('::of', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the specified values', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11);
        expect($actual->toArray())->toBe([2, 3, 5, 7, 11]);
    });
});

describe('::empty', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::empty();
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return an empty instance', function (): void {
        $actual = Seq::empty();
        expect($actual->toArray())->toBe([]);
    });
});

describe('->count', function (): void {
    it('should return the number of elements', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->count();
        expect($actual)->toBe(5);
    });
});

describe('->countBy', function (): void {
    it('should return the number of elements that satisfy the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->countBy(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toBe(4);
    });
});

describe('->drop', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->drop(2);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return itself if the number is less than or equal to 0', function (): void {
        $seq = Seq::of(2, 3, 5, 7, 11);
        $actual = $seq->drop(0);
        expect($actual)->toBe($seq);
    });

    it('should return a new instance with the first n elements removed', function (int $n, array $expected): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->drop($n);
        expect($actual->toArray())->toBe($expected);
    })->with([
        [1, [3, 5, 7, 11]],
        [2, [5, 7, 11]],
        [3, [7, 11]],
        [4, [11]],
    ]);

    it('should return an empty instance if the number is greater than the size', function (int $n): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->drop($n);
        expect($actual->toArray())->toBe([]);
    })->with([
        [5],
        [6],
        [7],
    ]);
});

describe('->each', function (): void {
    it('should call the callback for each element', function (): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        Seq::of(2, 3, 5, 7, 11)->each($f);

        // Assert
        $spy->shouldHaveReceived('__invoke')->times(5);
        $spy->shouldHaveReceived('__invoke')->with(2, 0);
        $spy->shouldHaveReceived('__invoke')->with(3, 1);
        $spy->shouldHaveReceived('__invoke')->with(5, 2);
        $spy->shouldHaveReceived('__invoke')->with(7, 3);
        $spy->shouldHaveReceived('__invoke')->with(11, 4);
    });

    it('should not call the callback if the sequence is empty', function (): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        Seq::empty()->each($f);

        // Assert
        $spy->shouldNotHaveReceived('__invoke');
    });
});

describe('->exists', function (): void {
    it('should return true if any element satisfies the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->exists(fn (int $x): bool => $x % 5 === 0);
        expect($actual)->toBeTrue();
    });

    it('should return false if no element satisfies the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->exists(fn (int $x): bool => $x % 13 === 0);
        expect($actual)->toBeFalse();
    });
});

describe('->filter', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->filter(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the elements that satisfy the predicate', function (): void {
        $actual = Seq::of(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)->filter(fn (int $x): bool => $x % 2 !== 0);
        expect($actual->toArray())->toBe([1, 3, 5, 7, 9]);
    });
});

describe('->filterNot', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->filterNot(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the elements that do not satisfy the predicate', function (): void {
        $actual = Seq::of(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)->filterNot(fn (int $x): bool => $x % 2 !== 0);
        expect($actual->toArray())->toBe([0, 2, 4, 6, 8]);
    });
});

describe('->getIterator', function (): void {
    it('should return an ArrayIterator', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->getIterator();
        expect($actual)->toBeInstanceOf(ArrayIterator::class);
    });

    it('should return an iterator that iterates the values', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->getIterator();
        expect(iterator_to_array($actual))->toBe([2, 3, 5, 7, 11]);
    });
});

describe('->map', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->map(fn ($v): int => $v * 3);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the mapped values', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->map(fn ($v): int => $v * 3);
        expect($actual->toArray())->toBe([6, 9, 15, 21, 33]);
    });
});

describe('->offsetExists', function (): void {
    it('should return true if the index exists', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->offsetExists(3);
        expect($actual)->toBeTrue();
    });

    it('should return false if the index does not exist', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->offsetExists(5);
        expect($actual)->toBeFalse();
    });
});

describe('->offsetGet', function (): void {
    it('should return the value at the specified index', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->offsetGet(3);
        expect($actual)->toBe(7);
    });

    it('should throw an OutOfBoundsException if the index is out of bounds', function (): void {
        expect(fn () => Seq::of(2, 3, 5, 7, 11)->offsetGet(5))->toThrow(OutOfBoundsException::class);
    });
});

describe('->offsetSet', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => Seq::of(2, 3, 5, 7, 11)->offsetSet(0, 2))->toThrow(BadMethodCallException::class);
    });
});

describe('->offsetUnset', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => Seq::of(2, 3, 5, 7, 11)->offsetUnset(0))->toThrow(BadMethodCallException::class);
    });
});

describe('->size', function (): void {
    it('should return the number of elements', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->size();
        expect($actual)->toBe(5);
    });
});

describe('->toArray', function (): void {
    it('should return the representation of the sequence as an array', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->toArray();
        expect($actual)->toBe([2, 3, 5, 7, 11]);
    });
});

describe('->toSeq', function (): void {
    it('should return itself', function (): void {
        $seq = Seq::of(2, 3, 5, 7, 11);
        $actual = $seq->toSeq();
        expect($actual)->toBe($seq);
    });
});
