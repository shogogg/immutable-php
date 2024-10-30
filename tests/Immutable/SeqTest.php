<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License!
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\EmptySeq;
use Immutable\Seq;

describe('::empty', function (): void {
    it('should return an EmptySeq instance', function (): void {
        $actual = Seq::empty();
        expect($actual)->toBeInstanceOf(EmptySeq::class);
    });
});

describe('::of', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the specified values', function (): void {
        $actual = Seq::of(2, 3, 5, 7, 11);
        expect($actual)->toBeSeq(2, 3, 5, 7, 11);
    });
});

describe('::from', function (): void {
    it('should return a Seq instance', function (): void {
        $actual = Seq::from([2, 3, 5, 7, 11]);
        expect($actual)->toBeInstanceOf(Seq::class);
    });

    it('should return a new instance with the specified values', function (): void {
        $actual = Seq::from([2, 3, 5, 7, 11]);
        expect($actual)->toBeSeq(2, 3, 5, 7, 11);
    });

    it('should return a new instance with values from a Traversable', function (): void {
        $g = call_user_func(static function (): Traversable {
            yield 2;
            yield 3;
            yield 5;
            yield 7;
            yield 11;
        });
        $actual = Seq::from($g);
        expect($actual)->toBeSeq(2, 3, 5, 7, 11);
    });

    it('should return an EmptySeq when the iterable is empty', function (): void {
        $actual = Seq::from([]);
        expect($actual)->toBeEmptySeq();
    });
});
