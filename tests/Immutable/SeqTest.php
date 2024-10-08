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

describe('->toArray', function (): void {
    it('should return the representation of the sequence as an array', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11)->toArray();
        expect($actual)->toBe([2, 3, 5, 7, 11]);
    });
});
