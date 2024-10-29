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
}
