<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

/**
 * Immutable Collection Interface.
 *
 * @template K of int|string
 * @template-covariant T
 * @extends \ArrayAccess<K, mixed>
 * @extends \IteratorAggregate<K, T>
 */
interface CollectionLike extends \ArrayAccess, \Countable, \IteratorAggregate
{
    /**
     * Counts the number of elements in the collection which satisfy a predicate.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     * @return int the number of elements satisfying the predicate.
     */
    public function countBy(\Closure $p): int;

    /**
     * Selects all elements except first `$n` ones.
     *
     * @param int $n the number of elements to drop from this collection.
     *
     * @return \Immutable\CollectionLike<K, T> a collection consisting of all elements of this collection except the
     *                                         first n ones, or else the empty collection, if this collection has less
     *                                         than n elements. If n is negative, don't drop any elements.
     */
    public function drop(int $n): CollectionLike;

    /**
     * Apply `$f` to each element for its side effects.
     *
     * @param \Closure(T, K): void $f the function to apply to each element.
     */
    public function each(\Closure $f): void;

    /**
     * Tests whether a predicate holds for at least one element of this collection.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     *
     * @return bool true if the given predicate `$p` is satisfied by at least one element of this collection,
     *              otherwise false.
     */
    public function exists(\Closure $p): bool;

    /**
     * Builds a new collection by applying a function to all elements of this collection.
     *
     * @template U
     * @param \Closure(T, K): U $f the function to apply to each element.
     *
     * @return \Immutable\CollectionLike<K, U>
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function map(\Closure $f);

    /**
     * Returns the size of this collection.
     *
     * @return int
     */
    public function size(): int;

    /**
     * Converts this collection to an array.
     *
     * @return array<T>
     */
    public function toArray(): array;

    /**
     * Converts this collection to a sequence.
     *
     * @return \Immutable\Seq<T>
     */
    public function toSeq(): Seq;
}
