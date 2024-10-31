<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable\Companions;

use Immutable\None;
use Immutable\Some;

/**
 * Companion object for Option.
 *
 * @internal
 */
final class OptionCompanion
{
    private static ?None $none = null;

    /**
     * Returns the None instance.
     *
     * @return \Immutable\None
     */
    public static function none(): None
    {
        if (self::$none === null) {
            self::$none = new None();
        }
        return self::$none;
    }

    /**
     * Returns a Some instance with the given value.
     *
     * @template T
     *
     * @param T $value
     *
     * @return \Immutable\Some<T>
     */
    public static function some(mixed $value): Some
    {
        return Some::of($value);
    }
}
