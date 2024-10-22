<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\None;
use Immutable\Option;
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

describe('->each', function (): void {
    it('should call the callback once', function (): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        Some::of(17)->each($f);

        // Assert
        $spy->shouldHaveReceived('__invoke')->once();
    });

    it('should call the callback with the value', function (mixed $value): void {
        // Arrange
        $spy = Mockery::spy(function (mixed $x): void {
            // Nothing to do.
        });
        $f = spyFunction($spy);

        // Act
        Some::of($value)->each($f);

        // Assert
        $spy->shouldHaveReceived('__invoke')->with($value, 0);
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

describe('->exists', function (): void {
    it('should return true when the predicate returns true', function (): void {
        $actual = Some::of(17)->exists(fn (int $x): bool => $x === 17);
        expect($actual)->toBeTrue();
    });

    it('should return false when the predicate returns false', function (): void {
        $actual = Some::of(17)->exists(fn (int $x): bool => $x !== 17);
        expect($actual)->toBeFalse();
    });
});

describe('->filter', function (): void {
    it('should return a Some instance when the predicate returns true', function (): void {
        $actual = Some::of(17)->filter(fn (int $x): bool => $x === 17);
        expect($actual)->toBeInstanceOf(Some::class);
    });

    it('should return a None instance when the predicate returns false', function (): void {
        $actual = Some::of(17)->filter(fn (int $x): bool => $x !== 17);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->filterNot', function (): void {
    it('should return a None instance when the predicate returns true', function (): void {
        $actual = Some::of(17)->filterNot(fn (int $x): bool => $x === 17);
        expect($actual)->toBeInstanceOf(None::class);
    });

    it('should return a Some instance when the predicate returns false', function (): void {
        $actual = Some::of(17)->filterNot(fn (int $x): bool => $x !== 17);
        expect($actual)->toBeInstanceOf(Some::class);
    });
});

describe('->find', function (): void {
    it('should return itself when the predicate returns true', function (): void {
        $actual = Some::of(17)->find(fn (int $x): bool => $x === 17);
        expect($actual)->toBeInstanceOf(Some::class);
    });

    it('should return a None instance when the predicate returns false', function (): void {
        $actual = Some::of(17)->find(fn (int $x): bool => $x !== 17);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->flatMap', function (): void {
    it('should return the Option instance returned by the callback', function (\Closure $f, $expected): void {
        $actual = Some::of(17)->flatMap($f);
        expect($actual)->toEqual($expected);
    })->with([
        [fn (int $x): Option => Some::of($x * 2), Some::of(34)],
        [fn (int $x): Option => None::instance(), None::instance()],
    ]);

    it('should throw a LogicException if the callback does not return an Option instance', function (): void {
        // @phpstan-ignore argument.type
        expect(fn () => Some::of(17)->flatMap(fn (int $x): int => $x * 2))->toThrow(LogicException::class);
    });
});

describe('->flatten', function (): void {
    it('should return the value if it is an Option instance', function (Option $value): void {
        $actual = Some::of($value)->flatten();
        expect($actual)->toBe($value);
    })->with([
        [Some::of(17)],
        [Some::of('foo')],
        [None::instance()],
    ]);

    it('should throw a LogicException if the value is not an Option instance', function (): void {
        expect(fn () => Some::of(17)->flatten())->toThrow(LogicException::class);
    });
});

describe('->fold', function (): void {
    it('should return the result of the callback', function (): void {
        $actual = Some::of(17)->fold(19, fn (int $z, int $x): int => $z + $x);
        expect($actual)->toBe(36);
    });
});

describe('->forAll', function (): void {
    it('should return true when the predicate returns true', function (): void {
        $actual = Some::of(17)->forAll(fn (int $value): bool => $value > 0);
        expect($actual)->toBeTrue();
    });

    it('should return false when the predicate returns false', function (): void {
        $actual = Some::of(17)->forAll(fn (int $value): bool => $value < 0);
        expect($actual)->toBeFalse();
    });
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

describe('->isEmpty', function (): void {
    it('should return false even if the value is any type', function (mixed $value): void {
        $actual = Some::of($value)->isEmpty();
        expect($actual)->toBeFalse();
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

describe('->map', function (): void {
    it('should return a new instance with the mapped value', function (): void {
        $actual = Some::of(17)->map(fn ($v): int => $v * 2);
        expect($actual)->toBeInstanceOf(Some::class)->toEqual(Some::of(34));
    });
});

describe('->nonEmpty', function (): void {
    it('should return true even if the value is any type', function (mixed $value): void {
        $actual = Some::of($value)->nonEmpty();
        expect($actual)->toBeTrue();
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
    it('should return a Seq instance with the value', function (): void {
        $actual = Some::of('foo')->toSeq();
        expect($actual)->toBeInstanceOf(Seq::class)->toEqual(Seq::of('foo'));
    });
});
