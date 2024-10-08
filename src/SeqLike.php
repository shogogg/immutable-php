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
}
