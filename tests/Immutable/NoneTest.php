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

describe('->get', function (): void {
    it('should throw a LogicException', function (): void {
        expect(fn () => None::of(0)->get())->toThrow(LogicException::class);
    });
});

describe('->map', function (): void {
    it('should return a None instance', function (): void {
        $actual = None::of(0)->map(fn (int $value): int => $value * 2);
        expect($actual)->toBeInstanceOf(None::class);
    });
});

describe('->toArray', function (): void {
    it('should return an empty array', function (): void {
        $actual = None::instance()->toArray();
        expect($actual)->toBe([]);
    });
});
