<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\Option;

describe('::of', function (): void {
    it('should return None when the value is null', function (): void {
        $actual = Option::of(null);
        expect($actual)->toBeNone();
    });

    it('should return Some when the value is not null', function (mixed $value): void {
        $actual = Option::of($value);
        expect($actual)->toBeSome($value);
    })->with([
        [0],
        [0.0],
        ['foo'],
        [[]],
        [new stdClass()],
    ]);
});

describe('::fromArray', function (): void {
    it('should return Some when the key exists in the array', function (array|\ArrayAccess $array): void {
        $actual = Option::fromArray($array, 'age');
        expect($actual)->toBeSome(43);
    })->with([
        [['name' => 'Fernando Alonso', 'age' => 43]],
        [new ArrayObject(['name' => 'Fernando Alonso', 'age' => 43])],
    ]);

    it('should return None when the key does not exist in the array', function (array|\ArrayAccess $array): void {
        $actual = Option::fromArray($array, 'nationality');
        expect($actual)->toBeNone();
    })->with([
        [['name' => 'Fernando Alonso', 'age' => 43]],
        [new ArrayObject(['name' => 'Fernando Alonso', 'age' => 43])],
    ]);
});

describe('::none', function (): void {
    it('should return the None instance', function (): void {
        $actual = Option::none();
        expect($actual)->toBeNone();
    });
});

describe('::some', function (): void {
    it('should return a Some instance with the given value', function (mixed $value): void {
        $actual = Option::some($value);
        expect($actual)->toBeSome($value);
    })->with([
        [0],
        [0.0],
        ['foo'],
        [[]],
        [new stdClass()],
        [null],
    ]);
});
