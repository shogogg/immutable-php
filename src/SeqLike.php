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
     * @param \Closure(T, int): iterable<int, U> $f
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
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): U $f
     * @return \Immutable\Seq<U>
     */
    #[\Override]
    public function map(\Closure $f): Seq;

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
}
