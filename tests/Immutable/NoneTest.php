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

describe('->get', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::of(0)->get())->toThrow(LogicException::class);
    });
});

describe('->getIterator', function (): void {
    it('should return an EmptyIterator', function (): void {
        $actual = None::instance()->getIterator();
        expect($actual)->toBeInstanceOf(EmptyIterator::class);
    });
});

describe('->map', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::of(0)->map(fn (int $value): int => $value * 2);
        expect($actual)->toBeInstanceOf(None::class);
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
        expect(fn () => None::of(0)->offsetGet(0))->toThrow(OutOfBoundsException::class);
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
    it('should return a Seq instance', function (): void {
        $actual = None::instance()->toSeq();
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return an empty Seq', function (): void {
        $actual = None::instance()->toSeq();
        expect($actual)->toBeEmpty();
    });
});
