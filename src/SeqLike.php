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
 * Seq Interface.
 *
 * @template-covariant T
 * @extends \Immutable\CollectionLike<int, T>
 */
interface SeqLike extends CollectionLike
{
    /**
     * Tests whether this sequence contains a given value as an element.
     *
     * @template U of T
     *
     * @param U $element the value to test.
     *
     * @return bool true if this sequence has an element that is equal (as determined by `===`) to `$element`,
     *              false otherwise.
     */
    public function contains(mixed $element): bool;

    /**
     * Selects all the elements of this sequence ignoring the duplicates.
     *
     * @return \Immutable\Seq<T> a new sequence consisting of all the elements of this sequence without duplicates.
     */
    public function distinct(): Seq;

    /**
     * Selects all the elements of this sequence ignoring the duplicates as determined by `===` after applying the transforming function `$f`.
     *
     * @template U
     *
     * @param \Closure(T, int): U $f the transforming function whose result is used to determine the uniqueness of each element.
     *
     * @return \Immutable\Seq<T> a new sequence consisting of all the elements of this sequence without duplicates.
     */
    public function distinctBy(\Closure $f): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function drop(int $n): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function dropRight(int $n): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function dropWhile(\Closure $p): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function filter(\Closure $p): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function filterNot(\Closure $p): Seq;

    /**
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): iterable<int, U> $f the function to apply to each element.
     * @throws \LogicException if the callback does not return an iterable.
     * @return \Immutable\Seq<U>
     */
    #[\Override]
    public function flatMap(\Closure $f): Seq;

    /**
     * {@inheritdoc}
     * @throws \LogicException if some elements are not iterable.
     * @return \Immutable\Seq<mixed>
     */
    #[\Override]
    public function flatten(): Seq;

    /**
     * Finds index of the first occurrence of some element in this sequence after or at some start index.
     *
     * @template U of T
     * @param U $element the element value to search for.
     * @param int $from the start index.
     *
     * @return int the index `>= $from` of the first element of this sequence that is equal (as determined by `===`) to
     *             `$element`, or -1, if none exists.
     */
    public function indexOf(mixed $element, int $from = 0): int;

    /**
     * Finds index of the first element satisfying some predicate after or at some start index.
     *
     * @param \Closure(T, int): bool $p the predicate used to test elements.
     * @param int $from the start index.
     *
     * @return int the index `>= $from` of the first element of this sequence that satisfies the predicate `$p`,
     *             or -1, if none exists.
     */
    public function indexWhere(\Closure $p, int $from = 0): int;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function init(): Seq;

    /**
     * Finds index of the last occurrence of some element in this sequence before or at some end index.
     *
     * @template U of T
     *
     * @param U $element the element value to search for.
     * @param int|null $end the end index.
     *
     * @return int the index `<= $end` of the last element of this sequence that is equal (as determined by `===`) to
     *             `$element`, or -1, if none exists.
     */
    public function lastIndexOf(mixed $element, ?int $end = null): int;

    /**
     * Finds index of last element satisfying some predicate before or at given end index.
     *
     * @param \Closure(T, int): bool $p the predicate used to test elements.
     * @param int|null $end the end index.
     *
     * @return int the index `<= $end` of the last element of this sequence that satisfies the predicate `$p`,
     *             or -1, if none exists.
     */
    public function lastIndexWhere(\Closure $p, ?int $end = null): int;

    /**
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): U $f the function to apply to each element.
     * @return \Immutable\Seq<U>
     */
    #[\Override]
    public function map(\Closure $f): Seq;

    /**
     * Returns a new sequence with the elements of this sequence in reverse order.
     *
     * @return \Immutable\Seq<T> a new sequence with all elements of this sequence in reverse order.
     */
    public function reverse(): Seq;

    /**
     * Sorts this sequence according to the natural ordering of its elements.
     *
     * @return \Immutable\Seq<T> a sequence consisting of the elements of this sequence sorted according to their natural ordering.
     */
    public function sorted(): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function tail(): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function take(int $n): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function takeRight(int $n): Seq;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function takeWhile(\Closure $p): Seq;
}
