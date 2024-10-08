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
use Immutable\Some;

describe('::of', function (): void {
    it('should return None when the value is null', function (): void {
        $actual = Option::of(null);
        expect($actual)->toBeInstanceOf(None::class);
    });

    it('should return Some when the value is not null', function (mixed $value): void {
        $actual = Option::of($value);
        expect($actual)->toBeInstanceOf(Some::class);
    })->with([
        [0],
        [0.0],
        ['foo'],
        [[]],
        [new stdClass()],
    ]);
});
