<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\Seq;
use Immutable\Some;

describe('::of', function (): void {
    it('should return a Some instance', function (mixed $value): void {
        $actual = Some::of($value);
        expect($actual)->toBeInstanceOf(Some::class);
    })->with([
        [0],
        [0.0],
        [17],
        ['foo'],
        [[]],
        [new stdClass()],
        [null],
    ]);

    it('should return a new instance with the specified value', function (mixed $value): void {
        $actual = Some::of($value);
        expect($actual->get())->toBe($value);
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
    it('should return 1', function (mixed $value): void {
        $actual = Some::of($value)->count();
        expect($actual)->toBe(1);
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

describe('->countBy', function (): void {
    it('should return 1 when the predicate returns true', function (): void {
        $actual = Some::of(17)->countBy(fn (int $value): bool => $value > 0);
        expect($actual)->toBe(1);
    });

    it('should return 0 when the predicate returns false', function (): void {
        $actual = Some::of(17)->countBy(fn (int $value): bool => $value < 0);
        expect($actual)->toBe(0);
    });
});

describe('->drop', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Some::of(17)->drop(0);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a Seq of the value when the argument less than or equal to 0', function (int $n): void {
        $actual = Some::of(17)->drop($n);
        expect($actual->toArray())->toBe([17]);
    })->with([
        [-2],
        [-1],
        [0],
    ]);

    it('should return an empty Seq when the argument greater than 0', function (int $n): void {
        $actual = Some::of(17)->drop($n);
        expect($actual)->toBeEmpty();
    })->with([
        [1],
        [2],
    ]);
});

describe('->get', function (): void {
    it('should return the value', function (mixed $value): void {
        $actual = Some::of($value)->get();
        expect($actual)->toBe($value);
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

describe('->getIterator', function (): void {
    it('should return an ArrayIterator', function (): void {
        $actual = Some::of(17)->getIterator();
        expect($actual)->toBeInstanceOf(ArrayIterator::class);
    });

    it('should return an iterator with the value', function (): void {
        $actual = Some::of(17)->getIterator();
        expect(iterator_to_array($actual))->toBe([17]);
    });
});

describe('->map', function (): void {
    it('should return a Some instance', function (): void {
        $actual = Some::of(17)->map(fn ($v): int => $v * 2);
        expect($actual)->toBeInstanceOf(Some::class);
    });

    it('should return a new instance with the mapped value', function (): void {
        $actual = Some::of(17)->map(fn ($v): int => $v * 2);
        expect($actual->get())->toBe(34);
    });
});

describe('->offsetExists', function (): void {
    it('should return true when the offset is 0', function (): void {
        $actual = Some::of(17)->offsetExists(0);
        expect($actual)->toBeTrue();
    });

    it('should return false when the offset is not 0', function (int $offset): void {
        $actual = Some::of(17)->offsetExists($offset);
        expect($actual)->toBeFalse();
    })->with([
        [-2],
        [-1],
        [1],
        [2],
    ]);
});

describe('->offsetGet', function (): void {
    it('should return the value when the offset is 0', function (): void {
        $actual = Some::of(17)->offsetGet(0);
        expect($actual)->toBe(17);
    });

    it('should throw an OutOfBoundsException when the offset is not 0', function (int $offset): void {
        expect(fn () => Some::of(17)->offsetGet($offset))->toThrow(OutOfBoundsException::class);
    })->with([
        [-2],
        [-1],
        [1],
        [2],
    ]);
});

describe('->offsetSet', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => Some::of(17)->offsetSet(0, 0))->toThrow(BadMethodCallException::class);
    });
});

describe('->offsetUnset', function (): void {
    it('should throw a BadMethodCallException', function (): void {
        expect(fn () => Some::of(17)->offsetSet(0, 0))->toThrow(BadMethodCallException::class);
    });
});

describe('->size', function (): void {
    it('should return 1', function (mixed $value): void {
        $actual = Some::of($value)->count();
        expect($actual)->toBe(1);
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

describe('->toArray', function (): void {
    it('should return an array', function (): void {
        $actual = Some::of('foo')->toArray();
        expect($actual)->toBe(['foo']);
    });
});

describe('->toSeq', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Some::of('foo')->toSeq();
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a Seq instance with the value', function (): void {
        $actual = Some::of('foo')->toSeq();
        expect($actual->toArray())->toBe(['foo']);
    });
});
