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
     *
     * @return int the number of elements satisfying the predicate.
     */
    public function countBy(\Closure $p): int;

    /**
     * Selects all elements except first `$n` ones.
     *
     * @param int $n the number of elements to drop from this collection.
     *
     * @return self<K, T> a collection consisting of all elements of this collection except the first n ones,
     *                    or else the empty collection, if this collection has less than n elements.
     *                    If n is negative, don't drop any elements.
     */
    public function drop(int $n): self;

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
     * Selects all elements of this collection which satisfy a predicate.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     *
     * @return self<K, T> a new collection consisting of all elements of this collection
     *                    that satisfy the given predicate `$p`.
     */
    public function filter(\Closure $p): self;

    /**
     * Selects all elements of this collection which do not satisfy a predicate.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     *
     * @return self<K, T> a new collection consisting of all elements of this collection
     *                    that do not satisfy the given predicate `$p`.
     */
    public function filterNot(\Closure $p): self;

    /**
     * Finds the first element of this collection satisfying a predicate, if any.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     *
     * @return \Immutable\Option<T> an Option containing the first element in this collection that satisfies `$p`,
     *                              or None if none exists.
     */
    public function find(\Closure $p): Option;

    /**
     * Builds a new collection by applying a function to all elements of this collection and using the elements of the resulting collections.
     *
     * @template U
     *
     * @param \Closure(T, K): iterable<int, U> $f the function to apply to each element.
     *
     * @return self<K, U> a new collection resulting from concatenating all element collections.
     */
    public function flatMap(\Closure $f): self;

    /**
     * Converts this collection of traversable collections into a collection formed by the elements of these collections.
     *
     * @return self<K, mixed> a new collection resulting from concatenating all element collections.
     */
    public function flatten(): self;

    /**
     * Folds the elements of this collection using the specified associative binary operator.
     *
     * @template U
     *
     * @param U $z a neutral element for the fold operation; may be added to the result an arbitrary number of times,
     *             and must not change the result (e.g., Nil for list concatenation, 0 for addition, or 1 for multiplication).
     * @param \Closure(U, T, K): U $op a binary operator that must be associative.
     *
     * @return U the result of applying the fold operator op between all the elements and z, or z if this collection is empty.
     */
    public function fold(mixed $z, \Closure $op): mixed;

    /**
     * Tests whether a predicate holds for all elements of this collection.
     *
     * @param \Closure(T, K): bool $p the predicate used to test elements.
     *
     * @return bool true if this collection is empty or the given predicate p holds for all elements of this collection,
     *              otherwise false.
     */
    public function forAll(\Closure $p): bool;

    /**
     * Selects the first element of this collection.
     *
     * @throws \LogicException if this collection is empty.
     *
     * @return T the first element of this collection.
     */
    public function head(): mixed;

    /**
     * Optionally selects the first element.
     *
     * @return \Immutable\Option<T> the first element of this collection if it is non-empty, None if it is empty.
     */
    public function headOption(): Option;

    /**
     * Tests whether this collection is empty.
     *
     * @return bool true if this collection contains no elements, false otherwise.
     */
    public function isEmpty(): bool;

    /**
     * Builds a new collection by applying a function to all elements of this collection.
     *
     * @template U
     *
     * @param \Closure(T, K): U $f the function to apply to each element.
     *
     * @return self<K, U>
     *
     * @noinspection PhpMissingReturnTypeInspection
     */
    public function map(\Closure $f);

    /**
     * Tests whether this collection is not empty.
     *
     * @return bool true if this collection does not contain any elements, false otherwise.
     */
    public function nonEmpty(): bool;

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
