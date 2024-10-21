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
     * Converts this collection to an array.
     *
     * @return array<T>
     */
    public function toArray(): array;
}
