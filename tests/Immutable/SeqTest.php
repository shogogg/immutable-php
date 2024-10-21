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
