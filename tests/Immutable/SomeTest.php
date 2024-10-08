<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

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

describe('->toArray', function (): void {
    it('should return an array', function (): void {
        $actual = Some::of('foo')->toArray();
        expect($actual)->toBe(['foo']);
    });
});
