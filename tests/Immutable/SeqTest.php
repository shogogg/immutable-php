<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License!
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\None;
use Immutable\Option;
use Immutable\Seq;
use Immutable\Some;

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
    it('should return an empty instance', function (): void {
        $actual = Seq::empty();
        expect($actual)->toBeInstanceOf(Seq::class)->toBeEmpty();
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

    it('should return a new instance with the first n elements removed', function (int $n, Seq $expected): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->drop($n);
        expect($actual)->toEqual($expected);
    })->with([
        [1, Seq::of(3, 5, 7, 11)],
        [2, Seq::of(5, 7, 11)],
        [3, Seq::of(7, 11)],
        [4, Seq::of(11)],
    ]);

    it('should return an empty instance if the number is greater than the size', function (int $n): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->drop($n);
        expect($actual)->toBeEmpty();
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
    it('should return a new instance with the elements that satisfy the predicate', function (): void {
        $actual = Seq::of(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)->filter(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toEqual(Seq::of(1, 3, 5, 7, 9));
    });
});

describe('->filterNot', function (): void {
    it('should return a new instance with the elements that do not satisfy the predicate', function (): void {
        $actual = Seq::of(0, 1, 2, 3, 4, 5, 6, 7, 8, 9)->filterNot(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toEqual(Seq::of(0, 2, 4, 6, 8));
    });
});

describe('->find', function (): void {
    it('should return a Some instance if the element is found', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->find(fn (int $x): bool => $x % 2 !== 0);
        expect($actual)->toBeInstanceOf(Some::class);
    });

    it('should return a Some of the first element that satisfies the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->find(fn (int $x): bool => $x % 2 !== 0);
        expect($actual->get())->toBe(3);
    });

    it('should return a None instance if the element that satisfies the predicate is not found', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->find(fn (int $x): bool => $x % 13 === 0);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->flatMap', function (): void {
    it('should return a new instance with the mapped values flattened', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->flatMap(fn (int $x): Seq => Seq::of($x, $x * 2));
        expect($actual)->toEqual(Seq::of(2, 4, 3, 6, 5, 10, 7, 14, 11, 22));
    });

    it('should throw a LogicException if the callback does not return a Seq instance', function (): void {
        // @phpstan-ignore-next-line
        expect(fn () => Seq::of(2, 3, 5, 7, 11)->flatMap(fn (int $x): int => $x * 2))->toThrow(LogicException::class);
    });
});

describe('->flatten', function (): void {
    it('should return a new instance with the elements flattened', function (): void {
        $seq = Seq::of(
            [2, 3],
            Seq::of(5, 7),
            Option::of(11),
        );
        $actual = $seq->flatten();
        expect($actual)->toEqual(Seq::of(2, 3, 5, 7, 11));
    });

    it('should throw a LogicException if either element is not an iterable', function (): void {
        $seq = Seq::of(
            [2, 3],
            5,
            Option::of(11),
        );
        expect(fn () => $seq->flatten())->toThrow(LogicException::class);
    });
});

describe('->fold', function (): void {
    it('should return the result of the callback', function (): void {
        $seq = Seq::of('bar', 'baz', 'qux');
        $actual = $seq->fold('foo', fn (string $z, string $x): string => "$z $x");
        expect($actual)->toBe('foo bar baz qux');
    });
});

describe('->forAll', function (): void {
    it('should return true if all elements satisfy the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->forAll(fn (int $x): bool => $x > 0);
        expect($actual)->toBeTrue();
    });

    it('should return false if any element does not satisfy the predicate', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->forAll(fn (int $x): bool => $x % 2 === 0);
        expect($actual)->toBeFalse();
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

describe('->head', function (): void {
    it('should return the first element', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->head();
        expect($actual)->toBe(2);
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->head())->toThrow(LogicException::class);
    });
});

describe('->headOption', function (): void {
    it('should return a Some of the first element', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->headOption();
        expect($actual)->toEqual(Some::of(2));
    });

    it('should return a None instance if the sequence is empty', function (): void {
        $actual = Seq::empty()->headOption();
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->isEmpty', function (): void {
    it('should return true if the sequence is empty', function (): void {
        $actual = Seq::empty()->isEmpty();
        expect($actual)->toBeTrue();
    });

    it('should return false if the sequence is not empty', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->isEmpty();
        expect($actual)->toBeFalse();
    });
});

describe('->last', function (): void {
    it('should return the last element', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->last();
        expect($actual)->toBe(11);
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->last())->toThrow(LogicException::class);
    });
});

describe('->lastOption', function (): void {
    it('should return a Some of the last element', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->lastOption();
        expect($actual)->toEqual(Some::of(11));
    });

    it('should return a None instance if the sequence is empty', function (): void {
        $actual = Seq::empty()->lastOption();
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->map', function (): void {
    it('should return a new instance with the mapped values', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->map(fn ($v): int => $v * 3);
        expect($actual)->toEqual(Seq::of(6, 9, 15, 21, 33));
    });
});

describe('->max', function (): void {
    it('should return the maximum value', function (): void {
        $actual = Seq::of(5, 11, 3, 19, 2, 13, 17, 7)->max();
        expect($actual)->toBe(19);
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->max())->toThrow(LogicException::class);
    });
});

describe('->maxBy', function (): void {
    it('should return the element that the callback returns the maximum value', function (): void {
        $seq = Seq::of(
            'PHP',
            'Ruby',
            'Python',
            'JavaScript',
            'Java',
            'Scala',
        );
        $actual = $seq->maxBy(fn (string $x): int => strlen($x));
        expect($actual)->toBe('JavaScript');
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->maxBy(fn (string $x): int => strlen($x)))->toThrow(LogicException::class);
    });
});

describe('->min', function (): void {
    it('should return the minimum value', function (): void {
        $actual = Seq::of(5, 11, 3, 19, 2, 13, 17, 7)->min();
        expect($actual)->toBe(2);
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->min())->toThrow(LogicException::class);
    });
});

describe('->minBy', function (): void {
    it('should return the element that the callback returns the minimum value', function (): void {
        $seq = Seq::of(
            'PHP',
            'Ruby',
            'Python',
            'JavaScript',
            'Java',
            'Scala',
        );
        $actual = $seq->minBy(fn (string $x): int => strlen($x));
        expect($actual)->toBe('PHP');
    });

    it('should throw a LogicException if the sequence is empty', function (): void {
        expect(fn () => Seq::empty()->minBy(fn (string $x): int => strlen($x)))->toThrow(LogicException::class);
    });
});

describe('->nonEmpty', function (): void {
    it('should return true if the sequence is not empty', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->nonEmpty();
        expect($actual)->toBeTrue();
    });

    it('should return false if the sequence is empty', function (): void {
        $actual = Seq::empty()->nonEmpty();
        expect($actual)->toBeFalse();
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
