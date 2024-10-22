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
 * Option Interface.
 *
 * @template-covariant T
 * @extends \Immutable\CollectionLike<int, T>
 */
interface OptionLike extends CollectionLike
{
    /**
     * Returns the value, throw exception if empty.
     *
     * @throws \LogicException if this Option is empty.
     * @return T
     */
    public function get(): mixed;

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
     * @return \Immutable\Option<T>
     */
    #[\Override]
    public function filter(\Closure $p): Option;

    /**
     * {@inheritdoc}
     * @return \Immutable\Option<T>
     */
    #[\Override]
    public function filterNot(\Closure $p): Option;

    /**
     * {@inheritdoc}
     * @throws \LogicException if the callback does not return an Option instance.
     * @return \Immutable\Option<mixed>
     */
    #[\Override]
    public function flatMap(\Closure $f): Option;

    /**
     * {@inheritdoc}
     * @throws \LogicException if the value is not an Option instance.
     * @return \Immutable\Option<T>
     */
    #[\Override]
    public function flatten(): Option;

    /**
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): U $f
     * @return \Immutable\Option<U>
     */
    #[\Override]
    public function map(\Closure $f): Option;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function take(int $n): Seq;
}
