<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

use Immutable\Companions\OptionCompanion;

/**
 * Option.
 *
 * @immutable
 * @template-covariant T
 * @implements \Immutable\OptionLike<T>
 */
abstract readonly class Option implements OptionLike
{
    /**
     * Returns an Option instance from the given value.
     *
     * @template U
     *
     * @param U $value a value
     *
     * @return self<U> Some of the value if it is not null, None otherwise.
     */
    public static function of(mixed $value): self
    {
        return match ($value) {
            null => OptionCompanion::none(),
            default => OptionCompanion::some($value),
        };
    }

    /**
     * Returns a new instance from an array.
     *
     * @template U
     *
     * @param array<U>|\ArrayAccess<int|string, U> $array an array
     * @param int|string $key key of the array
     *
     * @return self<U> Some of the value if given key exists in the array, None otherwise.
     */
    public static function fromArray(array|\ArrayAccess $array, int|string $key): self
    {
        return isset($array[$key]) ? OptionCompanion::some($array[$key]) : OptionCompanion::none();
    }

    /**
     * Returns the None instance.
     *
     * @return \Immutable\None
     */
    final public static function none(): None
    {
        return OptionCompanion::none();
    }

    /**
     * Returns a Some instance with the given value.
     *
     * @template U
     *
     * @param U $value
     *
     * @return \Immutable\Some<U>
     */
    final public static function some(mixed $value): Some
    {
        return OptionCompanion::some($value);
    }

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
