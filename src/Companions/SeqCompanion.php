<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable\Companions;

use Immutable\Seq;

/**
 * Companion object for Seq.
 */
final class SeqCompanion
{
    /** @var Seq<never> */
    private static Seq $empty;

    /**
     * Returns an empty sequence.
     *
     * @return Seq<never>
     */
    public static function empty(): Seq
    {
        if (!isset(self::$empty)) {
            /** @var never[] $elements */
            $elements = [];
            self::$empty = Seq::of(...$elements);
        }
        return self::$empty;
    }

    /**
     * Return a new iterable that applies a function to all elements of the given iterable.
     *
     * @template T
     * @template K
     * @template U
     * @param iterable<K, T> $it
     * @param \Closure(T, K): U $f
     * @return iterable<K, U>
     */
    public static function map(iterable $it, \Closure $f): iterable
    {
        return call_user_func(static function () use ($it, $f): iterable {
            foreach ($it as $k => $v) {
                yield $k => $f($v, $k);
            }
        });
    }
}
