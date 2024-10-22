<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

use Immutable\Iterators\ReverseArrayIterator;

describe('ReverseArrayIterator', function (): void {
    it('should iterate the elements in reverse order', function (): void {
        $it = ReverseArrayIterator::of([1, 2, 3, 4, 5]);
        $actual = [];
        foreach ($it as $value) {
            $actual[] = $value;
        }
        expect($actual)->toBe([5, 4, 3, 2, 1]);
    });
});
