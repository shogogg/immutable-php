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
    it('should return an EmptySeq instance', function (): void {
        $actual = Seq::empty();
        expect($actual)->toBeInstanceOf(EmptySeq::class);
    });
});
