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
 * Option.
 *
 * @template-covariant T
 * @implements \Immutable\OptionLike<T>
 */
abstract class Option implements OptionLike
{
    /**
     * Creates a new instance.
     *
     * @template U
     * @param U $value
     * @return self<U>
     */
    public static function of(mixed $value): self
    {
        return match ($value) {
            null => None::instance(),
            default => Some::of($value),
        };
    }

    /**
     * {@inheritdoc}
     *
     * @return \Immutable\Seq<T>
     */
    #[\Override]
    abstract public function drop(int $n): Seq;

    #[\Override]
    public function offsetSet(mixed $offset, mixed $value): void
    {
        throw new \BadMethodCallException();
    }

    #[\Override]
    public function offsetUnset(mixed $offset): void
    {
        throw new \BadMethodCallException();
    }
}
