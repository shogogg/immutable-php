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
}
