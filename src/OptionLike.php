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
     * Returns the value, throw exception if empty.
     *
     * @throws \LogicException if this Option is empty.
     * @return T
     */
    public function get(): mixed;

    /**
     * Returns the value if the option is non-empty, otherwise return the result of evaluating `$default`.
     *
     * @template U
     *
     * @param \Closure(): U $default the default value.
     *
     * @return T|U
     */
    public function getOrElse(\Closure $default): mixed;

    /**
     * Returns the value if the option is non-empty, otherwise return the specified value.
     *
     * @template U
     *
     * @param U $default the default value.
     *
     * @return T|U
     */
    public function getOrElseValue(mixed $default): mixed;

    /**
     * {@inheritdoc}
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    public function init(): Seq;

    /**
     * {@inheritdoc}
     * @template U
     * @param \Closure(T, int): U $f the function to apply to each element.
     * @return \Immutable\Option<U>
     */
    #[\Override]
    public function map(\Closure $f): Option;

    /**
     * Returns this Option if it is non-empty, otherwise return the result of evaluating `$alternative`.
     *
     * @template U
     *
     * @param \Closure(): Option<U> $alternative the alternative Option.
     *
     * @return \Immutable\Option<T|U>
     */
    public function orElse(\Closure $alternative): Option;

    /**
     * Returns this Option if it is non-empty, otherwise return the specified Option.
     *
     * @template U
     *
     * @param \Immutable\Option<U> $alternative the alternative Option.
     *
     * @return \Immutable\Option<T|U>
     */
    public function orElseValue(Option $alternative): Option;

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
