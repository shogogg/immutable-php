<?php
/*
 * Copyright (c) 2024 shogogg <shogo@studiofly.net>.
 *
 * This software is released under the MIT License.
 * http://opensource.org/licenses/mit-license.php
 */
declare(strict_types=1);

namespace Immutable;

use Immutable\Companions\SeqCompanion;

/**
 * Sequence.
 *
 * @immutable
 * @template-covariant T
 * @implements \Immutable\SeqLike<T>
 */
abstract readonly class Seq implements SeqLike
{
    /**
     * Returns an empty sequence.
     *
     * @return self<never>
     */
    final public static function empty(): self
    {
        return SeqCompanion::empty();
    }

    /**
     * Creates a new instance.
     *
     * @template U
     * @param U ...$elements
     * @return self<U>
     */
    public static function of(mixed ...$elements): self
    {
        return ArraySeq::of(...$elements);
    }

    /**
     * Creates a new instance from an iterable.
     *
     * @template U
     * @param iterable<int, U> $it
     * @return self<U>
     */
    protected static function fromIterable(iterable $it): self
    {
        return ArraySeq::fromIterable($it);
    }
}
